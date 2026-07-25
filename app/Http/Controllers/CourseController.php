<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\UserProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::where('is_published', true)
            ->with(['sections' => fn ($query) => $query->orderBy('position')])
            ->withCount(['sections'])
            ->orderBy('position')
            ->get();

        $enrolledIds = auth()->check()
            ? CourseEnrollment::where('user_id', auth()->id())->pluck('course_id')->all()
            : [];

        return view('courses.index', compact('courses', 'enrolledIds'));
    }

    public function show(Course $course): View
    {
        abort_unless($course->is_published, 404);

        $course->load(['sections.modules.lessons' => fn ($query) => $query->where('status', 'published')->orderBy('position')]);

        $enrollment = CourseEnrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        $lessonIds = $course->sections->flatMap->modules->flatMap->lessons->pluck('id');
        $completedIds = LessonCompletion::where('user_id', auth()->id())
            ->whereIn('lesson_id', $lessonIds)
            ->pluck('lesson_id')
            ->all();

        $totalLessons = $lessonIds->count();
        $completedCount = count($completedIds);
        $progressPercent = $totalLessons > 0 ? (int) round(($completedCount / $totalLessons) * 100) : 0;

        return view('courses.show', compact(
            'course', 'enrollment', 'completedIds', 'totalLessons', 'completedCount', 'progressPercent'
        ));
    }

    public function enroll(Course $course): RedirectResponse
    {
        CourseEnrollment::firstOrCreate(
            ['user_id' => auth()->id(), 'course_id' => $course->id],
            ['enrolled_at' => now()]
        );

        return redirect()->route('courses.show', $course)->with('success', $course->title.' unlocked successfully.');
    }

    public function complete(Lesson $lesson): RedirectResponse
    {
        $lesson->load('module.section.course');
        $course = $lesson->module?->section?->course;
        abort_unless($course, 404);

        $isEnrolled = CourseEnrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();
        abort_unless($isEnrolled, 403, 'Unlock this course first.');

        $completion = LessonCompletion::firstOrCreate(
            ['user_id' => auth()->id(), 'lesson_id' => $lesson->id],
            ['completed_at' => now()]
        );

        if ($completion->wasRecentlyCreated) {
            $progress = UserProgress::firstOrCreate(['user_id' => auth()->id()]);
            $progress->increment('xp', $lesson->xp_reward);
            $progress->increment('lessons_completed');
        }

        return back()->with('success', 'Lesson completed. The next lesson is now unlocked.');
    }
}
