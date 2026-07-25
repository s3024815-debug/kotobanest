<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 flex w-72 shrink-0 -translate-x-full flex-col justify-between overflow-y-auto bg-white p-6 transition-transform duration-200 ease-in-out lg:static lg:z-0 lg:translate-x-0 lg:flex">
        <div>
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-indigo-600 to-pink-500 text-lg font-black text-white">あ</span>
                    <span>
                        <span class="block text-lg font-black leading-tight">KotobaNest</span>
                        <span class="block text-xs font-medium text-slate-400">Your Home for Japanese</span>
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="rounded-lg p-1 text-slate-400 hover:bg-slate-100 lg:hidden">✕</button>
            </div>

            <nav class="space-y-1">
                <x-admin-nav-link :active="request()->routeIs('dashboard')" :href="route('dashboard')" icon="🏠">Dashboard</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('courses.*')" :href="route('courses.index')" icon="🗂️">My Courses</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('lessons.*')" :href="route('lessons.index')" icon="📖">Lessons</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('vocabulary.*')" :href="route('vocabulary.index')" icon="語">Vocabulary</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('kanji.*')" :href="route('kanji.index')" icon="漢">Kanji</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('quiz')" :href="route('quiz')" icon="📝">Quizzes</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('dictionary.*')" :href="route('dictionary.index')" icon="辞">Dictionary</x-admin-nav-link>

                <div class="my-3 border-t border-slate-100"></div>

                <span class="flex cursor-not-allowed items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-300">
                    <span class="w-5 text-center">📈</span> Progress <span class="ml-auto rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-bold text-slate-400">SOON</span>
                </span>
                <span class="flex cursor-not-allowed items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-300">
                    <span class="w-5 text-center">🏆</span> Achievements <span class="ml-auto rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-bold text-slate-400">SOON</span>
                </span>
                <span class="flex cursor-not-allowed items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-300">
                    <span class="w-5 text-center">👥</span> Community <span class="ml-auto rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-bold text-slate-400">SOON</span>
                </span>

                <div class="my-3 border-t border-slate-100"></div>

                <x-admin-nav-link :active="request()->routeIs('account.*')" :href="route('account.show')" icon="⚙️">Settings</x-admin-nav-link>
            </nav>
        </div>

        <div>
            <a href="{{ route('premium') }}" class="mb-3 block rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 p-5 text-white">
                <span class="text-xl">✨</span>
                <p class="mt-2 font-black leading-tight">Upgrade to Premium</p>
                <p class="mt-1 text-xs text-indigo-100">Unlock N3–N1 and more, coming soon.</p>
                <span class="mt-3 block rounded-xl bg-white py-2 text-center text-sm font-bold text-indigo-700">See Details →</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full rounded-xl bg-slate-900 px-4 py-3 text-left text-sm font-bold text-white hover:bg-slate-800">↩ Logout</button>
            </form>
        </div>
    </aside>

    <div class="flex min-w-0 flex-1 flex-col">
        <header class="flex items-center justify-between gap-4 border-b border-slate-200 bg-white px-4 py-4 sm:px-6">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="rounded-lg border border-slate-200 p-2 text-slate-500 lg:hidden">☰</button>
                <h1 class="text-lg font-black sm:text-xl">@yield('heading', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3 rounded-xl border border-slate-200 px-3 py-2">
                    <span class="grid h-8 w-8 place-items-center rounded-full bg-gradient-to-br from-indigo-600 to-pink-500 text-xs font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </span>
                    <span class="hidden text-sm leading-tight sm:block">
                        <span class="block font-bold">{{ auth()->user()->name }}</span>
                        <span class="block text-xs text-indigo-600">{{ auth()->user()->current_jlpt }} Learner</span>
                    </span>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
