<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\QuizAttempt;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $courses = Course::where('is_published', true)
            ->with(['sections.modules.lessons' => fn ($q) => $q->where('status', 'published')])
            ->orderBy('position')
            ->get();

        $enrolledIds = CourseEnrollment::where('user_id', $user->id)->pluck('course_id')->all();
        $completedLessonIds = LessonCompletion::where('user_id', $user->id)->pluck('lesson_id');

        $courseProgress = $courses->map(function ($course) use ($completedLessonIds, $enrolledIds) {
            $lessons = $course->sections->flatMap->modules->flatMap->lessons->values();
            $lessonIds = $lessons->pluck('id');
            $total = $lessonIds->count();
            $completed = $total > 0 ? $lessonIds->intersect($completedLessonIds)->count() : 0;

            return [
                'course' => $course,
                'lessons' => $lessons,
                'enrolled' => in_array($course->id, $enrolledIds, true),
                'total' => $total,
                'completed' => $completed,
                'percent' => $total > 0 ? (int) round(($completed / $total) * 100) : 0,
            ];
        });

        $activeCourse = $courseProgress->first(fn ($c) => $c['enrolled'] && $c['percent'] < 100)
            ?? $courseProgress->first(fn ($c) => $c['enrolled']);

        $nextLesson = null;
        if ($activeCourse) {
            $nextLesson = $activeCourse['lessons']->first(fn ($l) => ! $completedLessonIds->contains($l->id));
        }

        $progress = UserProgress::firstOrCreate(['user_id' => $user->id]);
        $quizzesTaken = QuizAttempt::where('user_id', $user->id)->count();

        $recommendedLevel = $user->placement_test_result ?: $user->current_jlpt;
        $recommendedCourse = Course::where('level', $recommendedLevel)->first();

        return view('student.dashboard', [
            'user' => $user,
            'progress' => $progress,
            'quizzesTaken' => $quizzesTaken,
            'activeCourse' => $activeCourse,
            'nextLesson' => $nextLesson,
            'courseProgress' => $courseProgress,
            'recommendedCourse' => $recommendedCourse,
        ]);
    }
}
