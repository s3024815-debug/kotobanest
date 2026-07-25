<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="{{ route('courses.index') }}" class="text-sm font-bold text-indigo-600">← All courses</a>
                <h2 class="mt-1 text-2xl font-black text-slate-900">{{ $course->title }} Curriculum</h2>
            </div>
            <span class="rounded-full bg-indigo-50 px-4 py-2 text-sm font-black text-indigo-700">{{ $course->level }}</span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 p-4 font-semibold text-emerald-700">{{ session('success') }}</div>
            @endif

            <section class="mb-8 rounded-3xl bg-slate-900 p-7 text-white shadow-xl">
                <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-indigo-300">Your course</p>
                        <h1 class="mt-2 text-3xl font-black">{{ $course->title }}</h1>
                        <p class="mt-2 max-w-2xl text-slate-300">{{ $course->description }}</p>
                    </div>
                    <div class="min-w-56">
                        <div class="flex justify-between text-sm font-bold"><span>Progress</span><span>{{ $progressPercent }}%</span></div>
                        <div class="mt-2 h-3 overflow-hidden rounded-full bg-slate-700"><div class="h-full rounded-full bg-indigo-400" style="width: {{ $progressPercent }}%"></div></div>
                        <p class="mt-2 text-xs text-slate-400">{{ $completedCount }} of {{ $totalLessons }} lessons completed</p>
                    </div>
                </div>
            </section>

            @unless ($enrollment)
                <div class="rounded-3xl border border-amber-200 bg-amber-50 p-8 text-center">
                    <h2 class="text-2xl font-black text-amber-900">This course is locked</h2>
                    <p class="mt-2 text-amber-700">Unlock it to begin the organized curriculum and track your progress.</p>
                    <form class="mt-5" method="POST" action="{{ route('courses.enroll', $course) }}">@csrf<button class="rounded-2xl bg-amber-600 px-6 py-3 font-bold text-white">Unlock {{ $course->level }}</button></form>
                </div>
            @else
                @php $sequence = 0; $previousComplete = true; @endphp
                <div class="space-y-7">
                    @foreach ($course->sections as $section)
                        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                            <header class="flex items-center gap-4 border-b border-slate-100 p-6">
                                <span class="text-3xl">{{ $section->icon }}</span>
                                <div><p class="text-xs font-black uppercase tracking-[0.18em] text-indigo-600">Section {{ $loop->iteration }}</p><h2 class="text-2xl font-black text-slate-900">{{ $section->name }}</h2></div>
                            </header>
                            <div class="space-y-5 p-6">
                                @foreach ($section->modules as $module)
                                    <div>
                                        <h3 class="font-black text-slate-800">Module {{ $loop->iteration }} · {{ $module->title }}</h3>
                                        @if($module->description)<p class="mt-1 text-sm text-slate-500">{{ $module->description }}</p>@endif
                                        <div class="mt-3 space-y-3">
                                            @foreach ($module->lessons as $lesson)
                                                @php
                                                    $sequence++;
                                                    $isComplete = in_array($lesson->id, $completedIds, true);
                                                    $isUnlocked = $previousComplete;
                                                @endphp
                                                <div class="flex flex-col gap-4 rounded-2xl border p-4 sm:flex-row sm:items-center sm:justify-between {{ $isComplete ? 'border-emerald-200 bg-emerald-50' : ($isUnlocked ? 'border-indigo-200 bg-indigo-50/40' : 'border-slate-200 bg-slate-50 opacity-70') }}">
                                                    <div class="flex items-center gap-4">
                                                        <span class="flex h-10 w-10 items-center justify-center rounded-full font-black {{ $isComplete ? 'bg-emerald-600 text-white' : ($isUnlocked ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-500') }}">{{ $isComplete ? '✓' : $sequence }}</span>
                                                        <div><h4 class="font-black text-slate-900">{{ $lesson->title }}</h4><p class="text-xs text-slate-500">{{ $lesson->estimated_minutes }} min · {{ $lesson->xp_reward }} XP</p></div>
                                                    </div>
                                                    @if ($isComplete)
                                                        <span class="font-bold text-emerald-700">Completed</span>
                                                    @elseif ($isUnlocked)
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('lessons.show', $lesson) }}" class="rounded-xl bg-white px-4 py-2 text-sm font-bold text-indigo-700 shadow-sm">Open</a>
                                                            <form method="POST" action="{{ route('lessons.complete', $lesson) }}">@csrf<button class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white">Complete</button></form>
                                                        </div>
                                                    @else
                                                        <span class="font-bold text-slate-400">🔒 Locked</span>
                                                    @endif
                                                </div>
                                                @php $previousComplete = $isComplete; @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>
            @endunless
        </div>
    </div>
</x-app-layout>
