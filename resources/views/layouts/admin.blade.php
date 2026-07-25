<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') · KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
         class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden"></div>

    {{-- Sidebar: static on desktop, slide-over drawer on mobile --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 flex w-72 shrink-0 -translate-x-full flex-col justify-between bg-white p-6 transition-transform duration-200 ease-in-out lg:static lg:z-0 lg:translate-x-0 lg:flex">
        <div>
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-indigo-600 to-pink-500 text-lg font-black text-white">あ</span>
                    <span>
                        <span class="block text-lg font-black leading-tight">KotobaNest</span>
                        <span class="block text-xs font-medium text-slate-400">Master Japanese</span>
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="rounded-lg p-1 text-slate-400 hover:bg-slate-100 lg:hidden">✕</button>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="mb-6 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }}">
                <span>🏠</span> Dashboard
            </a>

            <div class="mb-2 px-4 text-xs font-bold uppercase tracking-wider text-slate-400">Content</div>
            <nav class="mb-6 space-y-1">
                <x-admin-nav-link :active="request()->routeIs('admin.curriculum*')" :href="route('admin.curriculum')" icon="🗂️">Curriculum</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('admin.lessons*')" :href="route('admin.lessons')" icon="📖">Lessons</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('admin.vocabulary*')" :href="route('admin.vocabulary')" icon="🈶">Vocabulary</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('admin.kanji*')" :href="route('admin.kanji')" icon="漢">Kanji</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('admin.quiz*')" :href="route('admin.quiz')" icon="📝">Quizzes</x-admin-nav-link>
            </nav>

            <div class="mb-2 px-4 text-xs font-bold uppercase tracking-wider text-slate-400">Users</div>
            <nav class="space-y-1">
                <x-admin-nav-link :active="request()->routeIs('admin.users*')" :href="route('admin.users.index')" icon="👥">Users</x-admin-nav-link>
                <x-admin-nav-link :active="request()->routeIs('dashboard')" :href="route('dashboard')" icon="🎓">Student view</x-admin-nav-link>
            </nav>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full rounded-xl bg-slate-900 px-4 py-3 text-left text-sm font-bold text-white hover:bg-slate-800">
                ↩ Logout
            </button>
        </form>
    </aside>

    <div class="flex min-w-0 flex-1 flex-col">
        <header class="flex items-center justify-between gap-4 border-b border-slate-200 bg-white px-4 py-4 sm:px-6">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="rounded-lg border border-slate-200 p-2 text-slate-500 lg:hidden">☰</button>
                <div>
                    <h1 class="text-lg font-black sm:text-xl">@yield('heading', 'Admin')</h1>
                    <p class="hidden text-sm text-slate-400 sm:block">@yield('subheading', 'Manage KotobaNest')</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-500 md:block">
                    {{ now()->format('F j, Y') }}
                </span>
                <div class="flex items-center gap-3 rounded-xl border border-slate-200 px-3 py-2">
                    <span class="grid h-8 w-8 place-items-center rounded-full bg-gradient-to-br from-indigo-600 to-pink-500 text-xs font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </span>
                    <span class="hidden text-sm leading-tight sm:block">
                        <span class="block font-bold">{{ auth()->user()->name }}</span>
                        <span class="block text-xs text-slate-400">{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</span>
                    </span>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
