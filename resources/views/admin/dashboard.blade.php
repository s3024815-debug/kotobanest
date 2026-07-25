@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subheading', "Welcome back, ".auth()->user()->name.". Here's what's happening today.")

@section('content')

{{-- Stat cards --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
    @php
        $iconStyles = [
            'users' => ['bg' => 'from-indigo-500 to-purple-600', 'emoji' => '👥'],
            'lessons' => ['bg' => 'from-blue-500 to-blue-600', 'emoji' => '📖'],
            'vocabulary' => ['bg' => 'from-emerald-500 to-emerald-600', 'emoji' => 'あ'],
            'kanji' => ['bg' => 'from-amber-500 to-orange-500', 'emoji' => '漢'],
            'completions' => ['bg' => 'from-rose-500 to-pink-600', 'emoji' => '✅'],
        ];
    @endphp
    @foreach ($stats as $key => $stat)
        <div class="rounded-2xl bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-start justify-between">
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br {{ $iconStyles[$key]['bg'] }} text-lg font-bold text-white">
                    {{ $iconStyles[$key]['emoji'] }}
                </span>
            </div>
            <div class="text-sm font-semibold text-slate-400">{{ $stat['label'] }}</div>
            <div class="text-2xl font-black">{{ number_format($stat['total']) }}</div>
            <div class="mt-1 text-xs font-bold {{ $stat['change'] > 0 ? 'text-emerald-600' : 'text-slate-400' }}">
                @if ($stat['change'] > 0) ↗ {{ $stat['change'] }}% @else No change @endif in last 30 days
            </div>
        </div>
    @endforeach
</div>

{{-- Chart + activity --}}
<div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="rounded-2xl bg-white p-6 shadow-sm lg:col-span-2">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-black">User Growth</h2>
            <span class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-500">Last 7 days</span>
        </div>
        <canvas id="growthChart" height="110"></canvas>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-black">Recent Activity</h2>
        </div>
        <ol class="space-y-4">
            @forelse ($recentActivity as $item)
                @php
                    $dot = ['purple' => 'bg-indigo-500', 'blue' => 'bg-blue-500', 'green' => 'bg-emerald-500', 'orange' => 'bg-amber-500', 'red' => 'bg-rose-500'][$item['color']];
                @endphp
                <li class="flex gap-3">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full {{ $dot }}"></span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-bold">{{ $item['title'] }}</p>
                        <p class="truncate text-xs text-slate-400">{{ $item['detail'] }}</p>
                    </div>
                    <span class="shrink-0 text-xs text-slate-400">{{ $item['at']->diffForHumans(null, true) }}</span>
                </li>
            @empty
                <li class="text-sm text-slate-400">No activity yet.</li>
            @endforelse
        </ol>
    </div>
</div>

{{-- Quick actions --}}
<div class="mt-6 rounded-2xl bg-white p-6 shadow-sm">
    <h2 class="mb-4 text-lg font-black">Quick Actions</h2>
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
        <a href="{{ route('admin.curriculum') }}" class="rounded-xl bg-indigo-50 px-4 py-3 text-center text-sm font-bold text-indigo-700 hover:bg-indigo-100">🗂️ Curriculum</a>
        <a href="{{ route('admin.lessons') }}" class="rounded-xl bg-blue-50 px-4 py-3 text-center text-sm font-bold text-blue-700 hover:bg-blue-100">📖 Add Lesson</a>
        <a href="{{ route('admin.vocabulary') }}" class="rounded-xl bg-emerald-50 px-4 py-3 text-center text-sm font-bold text-emerald-700 hover:bg-emerald-100">あ Add Vocabulary</a>
        <a href="{{ route('admin.kanji') }}" class="rounded-xl bg-amber-50 px-4 py-3 text-center text-sm font-bold text-amber-700 hover:bg-amber-100">漢 Add Kanji</a>
        <a href="{{ route('admin.quiz') }}" class="rounded-xl bg-rose-50 px-4 py-3 text-center text-sm font-bold text-rose-700 hover:bg-rose-100">📝 Create Quiz</a>
    </div>
</div>

{{-- Bottom 3 columns --}}
<div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-black">Top Lessons</h2>
        </div>
        <ol class="space-y-3">
            @forelse ($topLessons as $i => $lesson)
                <li class="flex items-center justify-between gap-3">
                    <span class="min-w-0 truncate text-sm font-semibold">{{ $i + 1 }}. {{ $lesson->title }}</span>
                    <span class="shrink-0 rounded-lg bg-indigo-50 px-2 py-1 text-xs font-bold text-indigo-700">{{ $lesson->completions_count }} completions</span>
                </li>
            @empty
                <li class="text-sm text-slate-400">No completions yet.</li>
            @endforelse
        </ol>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-black">Recent Users</h2>
            <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-indigo-600">View All</a>
        </div>
        <ul class="space-y-3">
            @forelse ($recentUsers as $user)
                <li class="flex items-center gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-gradient-to-br from-indigo-500 to-pink-500 text-xs font-bold text-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-bold">{{ $user->name }}</p>
                        <p class="truncate text-xs text-slate-400">{{ $user->email }}</p>
                    </div>
                    <span class="shrink-0 text-xs text-slate-400">{{ $user->created_at->diffForHumans(null, true) }}</span>
                </li>
            @empty
                <li class="text-sm text-slate-400">No users yet.</li>
            @endforelse
        </ul>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-black">XP Leaderboard</h2>
        </div>
        <ol class="space-y-3">
            @forelse ($xpLeaderboard as $i => $progress)
                <li class="flex items-center gap-3">
                    <span class="w-5 shrink-0 text-sm font-black text-slate-400">{{ $i + 1 }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-bold">{{ $progress->user->name }}</p>
                        <p class="text-xs text-slate-400">Level {{ $progress->current_level }}</p>
                    </div>
                    <span class="shrink-0 text-sm font-black text-indigo-600">{{ number_format($progress->xp) }} XP</span>
                </li>
            @empty
                <li class="text-sm text-slate-400">No XP earned yet.</li>
            @endforelse
        </ol>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
    new Chart(document.getElementById('growthChart'), {
        type: 'line',
        data: {
            labels: @json($growth->pluck('label')),
            datasets: [{
                data: @json($growth->pluck('total')),
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79,70,229,0.08)',
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#4f46e5',
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
