<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Kanji;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\Vocabulary;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'lessons' => Lesson::where('status', 'published')->where('title', 'not like', '%Coming Soon%')->count(),
            'vocabulary' => Vocabulary::where('status', 'published')->count(),
            'kanji' => Kanji::where('status', 'published')->count(),
            'courses' => Course::where('is_published', true)->whereIn('level', ['N5', 'N4'])->count(),
        ];

        $courses = Course::where('is_published', true)
            ->whereIn('level', ['N5', 'N4'])
            ->with('sections.modules.lessons')
            ->orderBy('position')
            ->get()
            ->map(function ($course) {
                $lessons = $course->sections->flatMap->modules->flatMap->lessons;
                return [
                    'course' => $course,
                    'lessonCount' => $lessons->count(),
                ];
            });

        $continue = null;
        if (auth()->check()) {
            $user = auth()->user();
            $enrolledIds = CourseEnrollment::where('user_id', $user->id)->pluck('course_id');

            $course = Course::whereIn('id', $enrolledIds)
                ->with('sections.modules.lessons')
                ->orderBy('position')
                ->get()
                ->first();

            if ($course) {
                $lessons = $course->sections->flatMap->modules->flatMap->lessons->values();
                $completedIds = LessonCompletion::where('user_id', $user->id)
                    ->whereIn('lesson_id', $lessons->pluck('id'))
                    ->pluck('lesson_id');

                $total = $lessons->count();
                $completed = $completedIds->count();
                $nextLesson = $lessons->first(fn ($l) => ! $completedIds->contains($l->id));

                if ($nextLesson) {
                    $continue = [
                        'course' => $course,
                        'lesson' => $nextLesson,
                        'percent' => $total > 0 ? (int) round(($completed / $total) * 100) : 0,
                    ];
                }
            }
        }

        return view('welcome', compact('stats', 'continue', 'courses'));
    }
}
