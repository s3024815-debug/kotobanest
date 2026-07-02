<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            KotobaNest Dashboard
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow">
                    <p class="text-gray-500">Daily Streak</p>
                    <h3 class="text-4xl font-bold text-blue-600">1 Day</h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <p class="text-gray-500">XP</p>
                    <h3 class="text-4xl font-bold text-pink-500">0 XP</h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <p class="text-gray-500">Current Level</p>
                    <h3 class="text-4xl font-bold text-purple-600">N5</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-8">
                <h3 class="text-2xl font-bold mb-4">Welcome to KotobaNest 🎌</h3>
                <p class="text-gray-600 mb-6">
                    Start learning Japanese with daily lessons, quizzes, vocabulary, kanji, and JLPT practice.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>