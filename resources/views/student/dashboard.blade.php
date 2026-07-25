@extends('layouts.app-student')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">

        <div class="rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-pink-500 p-8 text-white">
            <p class="text-2xl font-black">👋 Welcome back, {{ $user->name }}!</p>
            <p class="mt-1 text-indigo-100">Let's keep learning Japanese today.</p>

            <div class="mt-6 grid grid-cols-3 gap-4">
                <div class="rounded-2xl bg-white/15 p-4">
                    <p class="text-xs font-semibold text-indigo-100">Current Level</p>
                    <p class="text-xl font-black">{{ $user->current_jlpt }}</p>
                </div>
                <div class="rounded-2xl bg-white/15 p-4">
                    <p class="text-xs font-semibold text-indigo-100">Lessons Completed</p>
                    <p class="text-xl font-black">{{ $progress->lessons_completed }}</p>
                </div>
                <div class="rounded-2xl bg-white/15 p-4">
                    <p class="text-xs font-semibold text-indigo-100">Total XP</p>
                    <p class="text-xl font-black">{{ number_format($progress->xp) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-black">Continue Learning</h2>
                <a href="{{ route('courses.index') }}" class="text-xs font-bold text-indigo-600">View All →</a>
            </div>

            @if ($activeCourse && $nextLesson)
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                    <span class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-indigo-500 to-pink-500 text-2xl font-black text-white">
                        {{ $activeCourse['course']->level }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <span class="rounded-full bg-indigo-50 px-2 py-0.5 text-[11px] font-bold text-indigo-700">IN PROGRESS</span>
                        <p class="mt-1 truncate font-bold">{{ $nextLesson->title }}</p>
                        <p class="text-sm text-slate-400">{{ $nextLesson->category }}</p>
                        <div class="mt-2 h-2 w-full max-w-xs overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full bg-indigo-600" style="width:{{ $activeCourse['percent'] }}%"></div>
                        </div>
                    </div>
                    <a href="{{ route('lessons.show', $nextLesson) }}" class="shrink-0 rounded-xl bg-indigo-600 px-5 py-2.5 text-center text-sm font-bold text-white hover:bg-indigo-700">Continue</a>
                </div>
            @elseif ($activeCourse)
                <div class="rounded-xl bg-emerald-50 p-4 text-sm font-semibold text-emerald-700">
                    🎉 You've completed every lesson in your {{ $activeCourse['course']->level }} course!
                    <a href="{{ route('courses.index') }}" class="underline">Pick another course →</a>
                </div>
            @else
                <div class="rounded-xl bg-slate-50 p-4 text-sm">
                    You haven't started a course yet.
                    <a href="{{ route('placement-test.index') }}" class="font-bold text-indigo-600">Take the placement test</a>
                    or <a href="{{ route('courses.index') }}" class="font-bold text-indigo-600">browse courses</a>.
                </div>
            @endif
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-black">Quick Practice</h2>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                <a href="{{ route('vocabulary.index') }}" class="rounded-xl bg-emerald-50 p-4 text-center hover:bg-emerald-100">
                    <div class="text-2xl">語</div>
                    <p class="mt-1 text-sm font-bold text-emerald-800">Vocabulary</p>
                </a>
                <a href="{{ route('kanji.index') }}" class="rounded-xl bg-amber-50 p-4 text-center hover:bg-amber-100">
                    <div class="text-2xl">漢</div>
                    <p class="mt-1 text-sm font-bold text-amber-800">Kanji Writing</p>
                </a>
                <a href="{{ route('quiz') }}" class="rounded-xl bg-rose-50 p-4 text-center hover:bg-rose-100">
                    <div class="text-2xl">📝</div>
                    <p class="mt-1 text-sm font-bold text-rose-800">Quiz</p>
                </a>
                <a href="{{ route('dictionary.index') }}" class="rounded-xl bg-blue-50 p-4 text-center hover:bg-blue-100">
                    <div class="text-2xl">辞</div>
                    <p class="mt-1 text-sm font-bold text-blue-800">Dictionary</p>
                </a>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-black">My Courses</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ($courseProgress as $cp)
                    <a href="{{ route('courses.show', $cp['course']) }}" class="rounded-xl border border-slate-100 p-4 hover:border-indigo-200 hover:bg-indigo-50/30">
                        <div class="text-2xl font-black text-slate-700">{{ $cp['course']->level }}</div>
                        <p class="font-bold">{{ $cp['course']->title }}</p>
                        @if ($cp['enrolled'])
                            <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                                <div class="h-full bg-indigo-600" style="width:{{ $cp['percent'] }}%"></div>
                            </div>
                            <p class="mt-1 text-xs text-slate-400">{{ $cp['completed'] }}/{{ $cp['total'] }} lessons</p>
                        @else
                            <p class="mt-2 text-xs text-slate-400">Tap to unlock</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-black">Your Progress</h2>
            <ul class="space-y-3 text-sm">
                <li class="flex items-center justify-between"><span class="text-slate-500">Lessons</span><span class="font-bold">{{ $progress->lessons_completed }}</span></li>
                <li class="flex items-center justify-between"><span class="text-slate-500">Quizzes taken</span><span class="font-bold">{{ $quizzesTaken }}</span></li>
                <li class="flex items-center justify-between"><span class="text-slate-500">Total XP</span><span class="font-bold">{{ number_format($progress->xp) }}</span></li>
                <li class="flex items-center justify-between"><span class="text-slate-500">Day streak</span><span class="font-bold">🔥 {{ $progress->streak }}</span></li>
            </ul>
        </div>

        @if ($recommendedCourse)
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h2 class="text-lg font-black">Recommended Course</h2>
                <p class="mb-3 text-xs text-slate-400">Based on your placement test</p>
                <div class="rounded-xl bg-gradient-to-br from-indigo-50 to-pink-50 p-4">
                    <span class="rounded-full bg-indigo-100 px-2 py-0.5 text-[11px] font-bold text-indigo-700">RECOMMENDED</span>
                    <p class="mt-2 text-xl font-black">{{ $recommendedCourse->title }}</p>
                    <a href="{{ route('courses.show', $recommendedCourse) }}" class="mt-3 block rounded-xl bg-indigo-600 py-2.5 text-center text-sm font-bold text-white hover:bg-indigo-700">Start Course →</a>
                </div>
            </div>
        @else
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h2 class="text-lg font-black">Not sure where to start?</h2>
                <a href="{{ route('placement-test.index') }}" class="mt-3 block rounded-xl bg-indigo-600 py-2.5 text-center text-sm font-bold text-white hover:bg-indigo-700">Take the Placement Test →</a>
            </div>
        @endif

        <a href="{{ route('premium') }}" class="block rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 p-6 text-white">
            <span class="text-xl">✨</span>
            <p class="mt-2 font-black">Upgrade to Premium</p>
            <p class="mt-1 text-xs text-indigo-100">Unlock all lessons and advanced features.</p>
            <span class="mt-3 block rounded-xl bg-white py-2 text-center text-sm font-bold text-indigo-700">See Details →</span>
        </a>
    </div>
</div>
@endsection
