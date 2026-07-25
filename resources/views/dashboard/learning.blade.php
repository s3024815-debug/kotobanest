<x-app-layout>
    <x-slot name="header"><div><p class="text-sm font-bold text-indigo-600">Welcome back</p><h2 class="text-2xl font-black text-slate-900">KotobaNest Learning Dashboard</h2></div></x-slot>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm font-bold text-slate-500">XP</p><h3 class="mt-2 text-4xl font-black text-indigo-600">{{ $progress->xp }}</h3></div>
                <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm font-bold text-slate-500">Streak</p><h3 class="mt-2 text-4xl font-black text-rose-500">{{ $progress->streak }} 🔥</h3></div>
                <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm font-bold text-slate-500">Favorites</p><h3 class="mt-2 text-4xl font-black text-violet-600">{{ $favoriteCount }}</h3></div>
                <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm font-bold text-slate-500">Notes</p><h3 class="mt-2 text-4xl font-black text-slate-700">{{ $noteCount }}</h3></div>
            </div>

            <div class="mb-8 flex items-center justify-between"><div><h3 class="text-2xl font-black text-slate-900">My courses</h3><p class="text-sm text-slate-500">Continue from your next unlocked lesson.</p></div><a href="{{ route('courses.index') }}" class="rounded-xl bg-indigo-600 px-4 py-2 font-bold text-white">Browse courses</a></div>

            @if($courseCards->isEmpty())
                <div class="mb-8 rounded-3xl border border-dashed border-indigo-300 bg-indigo-50 p-10 text-center"><div class="text-5xl">🗺️</div><h3 class="mt-4 text-2xl font-black text-slate-900">Start your learning path</h3><p class="mt-2 text-slate-600">Unlock N5, N4, N3, N2 or N1 and follow an organized curriculum.</p><a href="{{ route('courses.index') }}" class="mt-5 inline-block rounded-2xl bg-indigo-600 px-6 py-3 font-bold text-white">Choose a course</a></div>
            @else
                <div class="mb-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($courseCards as $card)
                        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm"><div class="flex items-center justify-between"><span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-black text-indigo-700">{{ $card['course']->level }}</span><span class="text-sm font-black text-slate-700">{{ $card['percent'] }}%</span></div><h4 class="mt-4 text-xl font-black text-slate-900">{{ $card['course']->title }}</h4><div class="mt-4 h-3 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-indigo-600" style="width: {{ $card['percent'] }}%"></div></div><p class="mt-2 text-xs text-slate-500">{{ $card['completed'] }} / {{ $card['total'] }} lessons</p><a href="{{ route('courses.show', $card['course']) }}" class="mt-5 block rounded-2xl bg-slate-900 px-5 py-3 text-center font-bold text-white">Continue learning</a></article>
                    @endforeach
                </div>
            @endif

            <div class="rounded-3xl bg-white p-8 shadow-sm"><h3 class="text-2xl font-black text-slate-900">Recent quiz attempts</h3>@forelse($attempts as $a)<p class="border-b py-3">Score: {{ $a->score }}/{{ $a->total }} — XP: {{ $a->xp_earned }}</p>@empty<p class="mt-3 text-slate-500">No quiz attempts yet.</p>@endforelse</div>
        </div>
    </div>
</x-app-layout>
