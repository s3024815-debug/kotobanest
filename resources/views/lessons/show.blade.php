<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson->title }} - KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
<header class="kb-nav">
    <a href="/" class="kb-logo"><span>あ</span>KotobaNest</a>
    <nav class="kb-links">
        <a href="/">Home</a>
        <a href="{{ route('lessons.index') }}">Lessons</a>
        <a href="{{ route('dictionary.index') }}">Dictionary</a>
        <a href="{{ route('quiz') }}">Quiz</a>
        @auth
            <a class="kb-login" href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a class="kb-login" href="{{ route('login') }}">Login</a>
        @endauth
    </nav>
</header>

@if ($course)
    @php
        $percent = $siblings->count() > 0 ? (int) round(($completedIds->count() / $siblings->count()) * 100) : 0;
        $position = $siblings->search(fn ($l) => $l->id === $lesson->id);
        $isComplete = $completedIds->contains($lesson->id);
    @endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6">
        <nav class="text-sm text-slate-400 font-semibold mb-3">
            <a href="{{ route('courses.show', $course) }}" class="hover:text-indigo-600">{{ $course->title }}</a>
            <span> &gt; </span><span class="text-slate-700">{{ $lesson->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-3 space-y-4">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-start justify-between gap-4 flex-wrap">
                        <div>
                            <span class="inline-block bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full mb-2">{{ $lesson->category }}</span>
                            <h1 class="text-2xl font-black text-slate-900">{{ $lesson->title }}</h1>
                        </div>
                        <form method="POST" action="{{ route('lessons.complete', $lesson) }}">
                            @csrf
                            <button class="rounded-xl px-4 py-2.5 text-sm font-bold {{ $isComplete ? 'bg-emerald-50 text-emerald-700' : 'bg-indigo-600 text-white hover:bg-indigo-700' }}" {{ $isComplete ? 'disabled' : '' }}>
                                {{ $isComplete ? '✓ Completed' : 'Mark as Complete' }}
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600" style="width:{{ $percent }}%"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">{{ $percent }}% of {{ $course->title }} complete</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    @include('lessons.partials.content', ['lesson' => $lesson])
                </div>

                <div class="flex items-center justify-between gap-3">
                    @if ($prevLesson)
                        <a href="{{ route('lessons.show', $prevLesson) }}" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50">← Previous Lesson</a>
                    @else
                        <span></span>
                    @endif
                    @if ($nextLesson)
                        <a href="{{ route('lessons.show', $nextLesson) }}" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-indigo-700">Next Lesson →</a>
                    @endif
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                    <p class="text-sm font-bold text-slate-700 mb-1">Lesson Progress</p>
                    <p class="text-xs text-slate-400 mb-3">Lesson {{ $position !== false ? $position + 1 : '?' }} of {{ $siblings->count() }}</p>
                    <div class="mx-auto grid place-items-center rounded-full" style="width:120px;height:120px;background:conic-gradient(#4f46e5 {{ $percent * 3.6 }}deg,#e2e8f0 0deg)">
                        <div class="grid place-items-center rounded-full bg-white" style="width:96px;height:96px;">
                            <span class="text-xl font-black text-slate-900">{{ $percent }}%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <p class="text-sm font-bold text-slate-700 mb-3">Lesson Navigation</p>
                    <div class="space-y-1 max-h-72 overflow-y-auto pr-1">
                        @foreach ($siblings as $i => $sib)
                            @php $done = $completedIds->contains($sib->id); @endphp
                            <a href="{{ route('lessons.show', $sib) }}" class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-sm {{ $sib->id === $lesson->id ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}">
                                <span class="w-5 text-center">{{ $done ? '✅' : ($i + 1) }}</span>
                                <span class="truncate">{{ $sib->title }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <p class="text-sm font-bold text-slate-700 mb-1">⏱ Study Time</p>
                    <p class="text-2xl font-black text-slate-900">{{ $lesson->estimated_minutes }} min</p>
                    <p class="text-xs text-slate-400">in this lesson</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <p class="text-sm font-bold text-slate-700 mb-3">Quick Actions</p>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('notes.index') }}" class="rounded-xl bg-slate-50 p-3 text-center text-xs font-bold text-slate-600 hover:bg-slate-100">📝<br>Take Notes</a>
                        <a href="{{ route('quiz') }}" class="rounded-xl bg-slate-50 p-3 text-center text-xs font-bold text-slate-600 hover:bg-slate-100">🎯<br>Practice Quiz</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <main class="kb-lesson-wrap">
        <nav style="font-size:.9rem;color:var(--muted);margin-bottom:1.25rem;font-weight:600;">
            <a href="{{ route('lessons.index') }}" style="color:var(--muted);text-decoration:none;">Lessons</a>
            <span> / </span>
            <a href="{{ route('lessons.index') }}?category={{ $lesson->category }}" style="color:var(--muted);text-decoration:none;">{{ $lesson->category }}</a>
            <span> / </span>
            <span style="color:var(--dark);">{{ $lesson->level }}</span>
        </nav>

        <article class="kb-lesson" style="position:relative;overflow:hidden;">
            <div style="position:absolute;inset:0 0 auto 0;height:8px;background:linear-gradient(90deg,var(--blue),var(--violet),var(--pink));"></div>
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;">
                <span style="display:inline-grid;place-items:center;width:3rem;height:3rem;border-radius:1rem;background:linear-gradient(135deg,var(--blue),var(--violet));color:#fff;font-weight:900;font-size:1.1rem;">{{ $lesson->level }}</span>
                <span class="kb-badge" style="margin:0;">{{ $lesson->category }}</span>
                <span style="margin-left:auto;font-size:.85rem;color:var(--muted);font-weight:600;">📖 {{ max(1, (int) ceil(str_word_count($lesson->content) / 180)) }} min read</span>
            </div>
            <h1>{{ $lesson->title }}</h1>
            @include('lessons.partials.content', ['lesson' => $lesson])
            <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:2rem;padding-top:1.5rem;border-top:1px solid var(--border);">
                <a class="kb-btn kb-secondary" href="{{ route('lessons.index') }}">← Back to Lessons</a>
                <a class="kb-btn kb-primary" href="{{ route('lessons.index') }}?category={{ $lesson->category }}&level={{ $lesson->level }}">More {{ $lesson->level }} {{ $lesson->category }} →</a>
            </div>
        </article>
    </main>
@endif

<footer class="kb-footer">© 2026 KotobaNest.</footer>

@if ($lesson->category === 'Reading')
<script>
    function readingLesson() {
        return {
            furiganaOn: false,
            detail: null,
            detailLoading: false,
            async handleClick(event) {
                const el = event.target.closest('.kb-ruby-word');
                if (!el) return;
                const word = el.dataset.word;
                this.detail = {};
                this.detailLoading = true;
                try {
                    const res = await fetch(`{{ route('dictionary.word') }}?word=${encodeURIComponent(word)}`);
                    this.detail = await res.json();
                } catch (e) {
                    this.detail = { word: word, meaning_en: 'Could not load details.' };
                } finally {
                    this.detailLoading = false;
                }
            }
        }
    }
</script>
@endif
</body>
</html>
