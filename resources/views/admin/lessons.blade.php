<x-app-layout>
<x-slot name="header"><h2 class="font-bold text-2xl text-gray-800 leading-tight">Admin Lessons</h2></x-slot>
<div class="py-10 bg-slate-50 min-h-screen"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="lg:flex gap-8">@include('admin.partials.sidebar')
<main class="flex-1 mt-8 lg:mt-0">@if(session('success'))<div class="mb-6 bg-green-100 text-green-700 p-4 rounded-xl font-bold">{{ session('success') }}</div>@endif
<div class="grid grid-cols-1 xl:grid-cols-2 gap-8"><div class="bg-white rounded-3xl shadow p-8"><h3 class="text-2xl font-black mb-6">Add New Lesson</h3>
<form method="POST" action="{{ route('admin.lessons.store') }}" class="space-y-4">@csrf
<div><label class="font-bold">Title</label><input name="title" class="w-full rounded-xl border-gray-300" required></div>
<div><label class="font-bold">Category</label><select name="category" class="w-full rounded-xl border-gray-300"><option>Grammar</option><option>Vocabulary</option><option>Kanji</option><option>Conversation</option><option>Japan Life</option></select></div>
<div><label class="font-bold">Level</label><select name="level" class="w-full rounded-xl border-gray-300"><option>N5</option><option>N4</option><option>N3</option><option>N2</option><option>N1</option><option>Daily Life</option></select></div>
<div><label class="font-bold">Status</label><select name="status" class="w-full rounded-xl border-gray-300"><option>published</option><option>draft</option></select></div>
<div><label class="font-bold">Content</label><textarea name="content" rows="8" class="w-full rounded-xl border-gray-300" required></textarea></div>
<button class="px-6 py-3 bg-blue-600 text-white rounded-full font-bold">Publish Lesson</button></form></div>
<div class="bg-white rounded-3xl shadow p-8"><h3 class="text-2xl font-black mb-6">All Lessons</h3><div class="space-y-4">@forelse($lessons as $lesson)<div class="border rounded-2xl p-4"><div class="flex items-start justify-between gap-4"><div><p class="font-bold">{{ $lesson->title }}</p><p class="text-sm text-gray-500">{{ $lesson->category }} • {{ $lesson->level }} • {{ $lesson->status }}</p></div><form method="POST" action="{{ route('admin.lessons.destroy',$lesson) }}" onsubmit="return confirm('Delete this lesson?')">@csrf @method('DELETE')<button class="text-red-600 font-bold">Delete</button></form></div></div>@empty<p class="text-gray-500">No lessons yet.</p>@endforelse</div><div class="mt-6">{{ $lessons->links() }}</div></div></div></main></div></div></div></x-app-layout>
