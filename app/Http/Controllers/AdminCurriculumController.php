<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseSection;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminCurriculumController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $courses = Course::query()
            ->withCount(['sections', 'enrollments'])
            ->withCount(['sections as modules_count' => fn ($query) => $query
                ->join('course_modules', 'course_sections.id', '=', 'course_modules.course_section_id')])
            ->withCount(['sections as lessons_count' => fn ($query) => $query
                ->join('course_modules', 'course_sections.id', '=', 'course_modules.course_section_id')
                ->join('lessons', 'course_modules.id', '=', 'lessons.course_module_id')])
            ->when($search !== '', fn ($query) => $query->where(function ($inner) use ($search) {
                $inner->where('title', 'like', "%{$search}%")
                    ->orWhere('level', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->orderBy('position')
            ->get();

        return view('admin.curriculum.index', compact('courses', 'search'));
    }

    public function showCourse(Request $request, Course $course): View
    {
        $search = trim((string) $request->query('q'));
        $sections = $course->sections()
            ->withCount('modules')
            ->withCount(['modules as lessons_count' => fn ($query) => $query
                ->join('lessons', 'course_modules.id', '=', 'lessons.course_module_id')])
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('position')
            ->get();

        return view('admin.curriculum.course', compact('course', 'sections', 'search'));
    }

    public function showSection(Request $request, CourseSection $section): View
    {
        $section->load('course');
        $search = trim((string) $request->query('q'));
        $modules = $section->modules()
            ->withCount('lessons')
            ->when($search !== '', fn ($query) => $query->where(function ($inner) use ($search) {
                $inner->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->orderBy('position')
            ->get();

        return view('admin.curriculum.section', compact('section', 'modules', 'search'));
    }

    public function showModule(Request $request, CourseModule $module): View
    {
        $module->load('section.course');
        $search = trim((string) $request->query('q'));
        $status = (string) $request->query('status', 'all');

        $lessons = $module->lessons()
            ->when($search !== '', fn ($query) => $query->where(function ($inner) use ($search) {
                $inner->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            }))
            ->when(in_array($status, ['published', 'draft'], true), fn ($query) => $query->where('status', $status))
            ->orderBy('position')
            ->paginate(15)
            ->withQueryString();

        return view('admin.curriculum.module', compact('module', 'lessons', 'search', 'status'));
    }

    public function editLesson(Lesson $lesson): View
    {
        $lesson->load('module.section.course');
        return view('admin.curriculum.lesson-edit', compact('lesson'));
    }

    public function storeCourse(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'level' => ['required', 'string', 'max:30'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $course = Course::create([
            'title' => $data['title'],
            'slug' => $this->uniqueCourseSlug($data['title']),
            'level' => strtoupper($data['level']),
            'description' => $data['description'] ?? null,
            'position' => (Course::max('position') ?? -1) + 1,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.curriculum.courses.show', $course)->with('success', 'Course created successfully.');
    }

    public function updateCourse(Request $request, Course $course): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'level' => ['required', 'string', 'max:30'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $course->update([
            'title' => $data['title'],
            'level' => strtoupper($data['level']),
            'description' => $data['description'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ]);

        return back()->with('success', 'Course updated successfully.');
    }

    public function destroyCourse(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect()->route('admin.curriculum')->with('success', 'Course and its curriculum were deleted.');
    }

    public function storeSection(Request $request, Course $course): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:20'],
        ]);

        $baseSlug = Str::slug($data['name']) ?: 'section';
        $slug = $baseSlug;
        $number = 2;
        while ($course->sections()->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$number++;
        }

        $course->sections()->create([
            'name' => $data['name'],
            'slug' => $slug,
            'icon' => $data['icon'] ?? '📘',
            'position' => ($course->sections()->max('position') ?? -1) + 1,
        ]);

        return back()->with('success', 'Section added successfully.');
    }

    public function updateSection(Request $request, CourseSection $section): RedirectResponse
    {
        $section->update($request->validate([
            'name' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:20'],
        ]));

        return back()->with('success', 'Section updated successfully.');
    }

    public function destroySection(CourseSection $section): RedirectResponse
    {
        $course = $section->course;
        $section->delete();
        return redirect()->route('admin.curriculum.courses.show', $course)->with('success', 'Section deleted successfully.');
    }

    public function storeModule(Request $request, CourseSection $section): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $section->modules()->create([
            ...$data,
            'position' => ($section->modules()->max('position') ?? -1) + 1,
        ]);

        return back()->with('success', 'Module added successfully.');
    }

    public function updateModule(Request $request, CourseModule $module): RedirectResponse
    {
        $module->update($request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]));

        return back()->with('success', 'Module updated successfully.');
    }

    public function destroyModule(CourseModule $module): RedirectResponse
    {
        $section = $module->section;
        $module->delete();
        return redirect()->route('admin.curriculum.sections.show', $section)->with('success', 'Module deleted successfully.');
    }

    public function storeLesson(Request $request, CourseModule $module): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'estimated_minutes' => ['required', 'integer', 'min:1', 'max:300'],
            'xp_reward' => ['required', 'integer', 'min:0', 'max:1000'],
            'status' => ['required', 'in:published,draft'],
        ]);

        $section = $module->section;
        $lesson = Lesson::create([
            'course_module_id' => $module->id,
            'title' => $data['title'],
            'category' => $section->name,
            'level' => $section->course->level,
            'content' => $data['content'] ?? '',
            'status' => $data['status'],
            'position' => ($module->lessons()->max('position') ?? -1) + 1,
            'estimated_minutes' => $data['estimated_minutes'],
            'xp_reward' => $data['xp_reward'],
        ]);

        return redirect()->route('admin.curriculum.lessons.edit', $lesson)->with('success', 'Lesson created. Add or edit its content below.');
    }

    public function updateLesson(Request $request, Lesson $lesson): RedirectResponse
    {
        $lesson->update($request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'estimated_minutes' => ['required', 'integer', 'min:1', 'max:300'],
            'xp_reward' => ['required', 'integer', 'min:0', 'max:1000'],
            'status' => ['required', 'in:published,draft'],
        ]));

        return back()->with('success', 'Lesson updated successfully.');
    }

    public function destroyLesson(Lesson $lesson): RedirectResponse
    {
        $module = $lesson->module;
        $lesson->delete();
        return redirect()->route('admin.curriculum.modules.show', $module)->with('success', 'Lesson deleted successfully.');
    }

    public function move(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => ['required', 'in:course,section,module,lesson'],
            'id' => ['required', 'integer'],
            'direction' => ['required', 'in:up,down'],
        ]);

        [$model, $siblings] = $this->sortableModelAndSiblings($data['type'], $data['id']);
        $operator = $data['direction'] === 'up' ? '<' : '>';
        $sort = $data['direction'] === 'up' ? 'desc' : 'asc';
        $neighbor = $siblings->where('position', $operator, $model->position)->orderBy('position', $sort)->first();

        if ($neighbor) {
            $oldPosition = $model->position;
            $model->update(['position' => $neighbor->position]);
            $neighbor->update(['position' => $oldPosition]);
        }

        return back()->with('success', 'Curriculum order updated.');
    }

    private function uniqueCourseSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'course';
        $slug = $base;
        $number = 2;
        while (Course::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$number++;
        }
        return $slug;
    }

    private function sortableModelAndSiblings(string $type, int $id): array
    {
        return match ($type) {
            'course' => (function () use ($id) { $model = Course::findOrFail($id); return [$model, Course::query()]; })(),
            'section' => (function () use ($id) { $model = CourseSection::findOrFail($id); return [$model, CourseSection::where('course_id', $model->course_id)]; })(),
            'module' => (function () use ($id) { $model = CourseModule::findOrFail($id); return [$model, CourseModule::where('course_section_id', $model->course_section_id)]; })(),
            'lesson' => (function () use ($id) { $model = Lesson::findOrFail($id); return [$model, Lesson::where('course_module_id', $model->course_module_id)]; })(),
        };
    }
}
