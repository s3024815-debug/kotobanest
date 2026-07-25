<?php
namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use Illuminate\Http\Request;
class LessonController extends Controller {
    public function index(Request $request) {
        $query = Lesson::where('status','published');
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title','like','%'.$request->q.'%')->orWhere('content','like','%'.$request->q.'%');
            });
        }
        if ($request->filled('category')) $query->where('category',$request->category);
        if ($request->filled('level')) $query->where('level',$request->level);
        $lessons = $query->latest()->paginate(9);
        return view('lessons.index', compact('lessons'));
    }
    public function show(Lesson $lesson) {
        abort_if($lesson->status !== 'published', 404);

        $course = null;
        $siblings = collect();
        $completedIds = collect();
        $prevLesson = null;
        $nextLesson = null;

        $lesson->loadMissing('module.section.course');
        if ($lesson->module?->section?->course) {
            $course = $lesson->module->section->course;
            $siblings = $course->sections()->with('modules.lessons')->get()
                ->flatMap->modules->flatMap->lessons->values();

            if (auth()->check()) {
                $completedIds = LessonCompletion::where('user_id', auth()->id())
                    ->whereIn('lesson_id', $siblings->pluck('id'))
                    ->pluck('lesson_id');
            }

            $position = $siblings->search(fn ($l) => $l->id === $lesson->id);
            if ($position !== false) {
                $prevLesson = $siblings->get($position - 1);
                $nextLesson = $siblings->get($position + 1);
            }
        }

        return view('lessons.show', [
            'lesson' => $lesson,
            'course' => $course,
            'siblings' => $siblings,
            'completedIds' => $completedIds,
            'prevLesson' => $prevLesson,
            'nextLesson' => $nextLesson,
        ]);
    }
}
