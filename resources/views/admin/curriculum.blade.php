<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Course Curriculum Manager</h2>
                <p class="text-sm text-slate-500">Arrange N5–N1 → sections → modules → lessons.</p>
            </div>
            <a href="{{ route('courses.index') }}" target="_blank" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white">Preview Courses</a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:gap-8">
                @include('admin.partials.sidebar')

                <main class="mt-8 min-w-0 flex-1 space-y-6 lg:mt-0">
                    @if(session('success'))
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 font-bold text-emerald-700">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
                            <p class="font-black">Please fix these fields:</p>
                            <ul class="mt-2 list-disc pl-5 text-sm">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                        <h3 class="text-lg font-black text-slate-900">Add a new course</h3>
                        <form method="POST" action="{{ route('admin.curriculum.courses.store') }}" class="mt-4 grid gap-3 md:grid-cols-5">
                            @csrf
                            <input name="title" required placeholder="JLPT N5" class="rounded-xl border-slate-300 md:col-span-1">
                            <input name="level" required placeholder="N5" class="rounded-xl border-slate-300">
                            <input name="description" placeholder="Course description" class="rounded-xl border-slate-300 md:col-span-2">
                            <label class="flex items-center gap-2 rounded-xl border border-slate-200 px-3 text-sm font-bold"><input type="checkbox" name="is_published" value="1" checked> Published</label>
                            <button class="rounded-xl bg-blue-600 px-4 py-3 font-black text-white md:col-span-5">+ Create Course</button>
                        </form>
                    </section>

                    @forelse($courses as $course)
                        <section class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                            <div class="border-b border-slate-200 bg-gradient-to-r from-slate-950 to-slate-800 p-5 text-white">
                                <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                                    <form method="POST" action="{{ route('admin.curriculum.courses.update', $course) }}" class="grid flex-1 gap-3 md:grid-cols-6">
                                        @csrf @method('PUT')
                                        <input name="title" value="{{ $course->title }}" class="rounded-xl border-white/20 bg-white/10 text-white placeholder-white/60 md:col-span-2">
                                        <input name="level" value="{{ $course->level }}" class="rounded-xl border-white/20 bg-white/10 text-white">
                                        <input name="description" value="{{ $course->description }}" class="rounded-xl border-white/20 bg-white/10 text-white placeholder-white/60 md:col-span-2">
                                        <label class="flex items-center gap-2 rounded-xl bg-white/10 px-3 text-sm font-bold"><input type="checkbox" name="is_published" value="1" @checked($course->is_published)> Published</label>
                                        <button class="rounded-xl bg-blue-500 px-4 py-2 font-black md:col-span-6">Save Course</button>
                                    </form>
                                    <div class="flex shrink-0 gap-2">
                                        @foreach(['up' => '↑', 'down' => '↓'] as $direction => $symbol)
                                            <form method="POST" action="{{ route('admin.curriculum.move') }}">@csrf<input type="hidden" name="type" value="course"><input type="hidden" name="id" value="{{ $course->id }}"><input type="hidden" name="direction" value="{{ $direction }}"><button class="rounded-xl bg-white/10 px-3 py-2 font-black">{{ $symbol }}</button></form>
                                        @endforeach
                                        <form method="POST" action="{{ route('admin.curriculum.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course and all its curriculum?')">@csrf @method('DELETE')<button class="rounded-xl bg-red-500 px-3 py-2 font-black">Delete</button></form>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-5 p-5">
                                @foreach($course->sections as $section)
                                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
                                            <form method="POST" action="{{ route('admin.curriculum.sections.update', $section) }}" class="grid flex-1 gap-2 sm:grid-cols-[90px_1fr_auto]">@csrf @method('PUT')
                                                <input name="icon" value="{{ $section->icon }}" class="rounded-xl border-slate-300" placeholder="📘">
                                                <input name="name" value="{{ $section->name }}" class="rounded-xl border-slate-300 font-bold">
                                                <button class="rounded-xl bg-slate-900 px-4 py-2 font-bold text-white">Save Section</button>
                                            </form>
                                            <div class="flex gap-2">
                                                @foreach(['up' => '↑', 'down' => '↓'] as $direction => $symbol)<form method="POST" action="{{ route('admin.curriculum.move') }}">@csrf<input type="hidden" name="type" value="section"><input type="hidden" name="id" value="{{ $section->id }}"><input type="hidden" name="direction" value="{{ $direction }}"><button class="rounded-lg border bg-white px-3 py-2 font-black">{{ $symbol }}</button></form>@endforeach
                                                <form method="POST" action="{{ route('admin.curriculum.sections.destroy', $section) }}" onsubmit="return confirm('Delete this section?')">@csrf @method('DELETE')<button class="rounded-lg bg-red-100 px-3 py-2 font-bold text-red-700">Delete</button></form>
                                            </div>
                                        </div>

                                        <div class="mt-4 space-y-4">
                                            @foreach($section->modules as $module)
                                                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                                                    <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
                                                        <form method="POST" action="{{ route('admin.curriculum.modules.update', $module) }}" class="grid flex-1 gap-2 md:grid-cols-[1fr_2fr_auto]">@csrf @method('PUT')
                                                            <input name="title" value="{{ $module->title }}" class="rounded-xl border-slate-300 font-bold">
                                                            <input name="description" value="{{ $module->description }}" class="rounded-xl border-slate-300" placeholder="Description">
                                                            <button class="rounded-xl bg-indigo-600 px-4 py-2 font-bold text-white">Save Module</button>
                                                        </form>
                                                        <div class="flex gap-2">
                                                            @foreach(['up' => '↑', 'down' => '↓'] as $direction => $symbol)<form method="POST" action="{{ route('admin.curriculum.move') }}">@csrf<input type="hidden" name="type" value="module"><input type="hidden" name="id" value="{{ $module->id }}"><input type="hidden" name="direction" value="{{ $direction }}"><button class="rounded-lg border px-3 py-2 font-black">{{ $symbol }}</button></form>@endforeach
                                                            <form method="POST" action="{{ route('admin.curriculum.modules.destroy', $module) }}" onsubmit="return confirm('Delete this module?')">@csrf @method('DELETE')<button class="rounded-lg bg-red-100 px-3 py-2 font-bold text-red-700">Delete</button></form>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4 space-y-2">
                                                        @foreach($module->lessons as $lesson)
                                                            <details class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                                                <summary class="cursor-pointer font-bold text-slate-800">{{ $lesson->position + 1 }}. {{ $lesson->title }} <span class="ml-2 text-xs text-slate-500">{{ $lesson->estimated_minutes }} min · {{ $lesson->xp_reward }} XP · {{ $lesson->status }}</span></summary>
                                                                <form method="POST" action="{{ route('admin.curriculum.lessons.update', $lesson) }}" class="mt-3 grid gap-2 md:grid-cols-6">@csrf @method('PUT')
                                                                    <input name="title" value="{{ $lesson->title }}" class="rounded-xl border-slate-300 md:col-span-3">
                                                                    <input type="number" min="1" name="estimated_minutes" value="{{ $lesson->estimated_minutes }}" class="rounded-xl border-slate-300" title="Minutes">
                                                                    <input type="number" min="0" name="xp_reward" value="{{ $lesson->xp_reward }}" class="rounded-xl border-slate-300" title="XP">
                                                                    <select name="status" class="rounded-xl border-slate-300"><option value="published" @selected($lesson->status==='published')>Published</option><option value="draft" @selected($lesson->status==='draft')>Draft</option></select>
                                                                    <textarea name="content" rows="4" class="rounded-xl border-slate-300 md:col-span-6" placeholder="Lesson content">{{ $lesson->content }}</textarea>
                                                                    <button class="rounded-xl bg-emerald-600 px-4 py-2 font-bold text-white md:col-span-3">Save Lesson</button>
                                                                    <div class="flex gap-2 md:col-span-3 md:justify-end">
                                                                        @foreach(['up' => '↑ Move', 'down' => '↓ Move'] as $direction => $label)<button form="move-lesson-{{ $lesson->id }}-{{ $direction }}" type="submit" class="rounded-lg border bg-white px-3 py-2 text-sm font-bold">{{ $label }}</button>@endforeach
                                                                        <button form="delete-lesson-{{ $lesson->id }}" type="submit" class="rounded-lg bg-red-100 px-3 py-2 text-sm font-bold text-red-700">Delete</button>
                                                                    </div>
                                                                </form>
                                                                @foreach(['up','down'] as $direction)<form id="move-lesson-{{ $lesson->id }}-{{ $direction }}" method="POST" action="{{ route('admin.curriculum.move') }}">@csrf<input type="hidden" name="type" value="lesson"><input type="hidden" name="id" value="{{ $lesson->id }}"><input type="hidden" name="direction" value="{{ $direction }}"></form>@endforeach
                                                                <form id="delete-lesson-{{ $lesson->id }}" method="POST" action="{{ route('admin.curriculum.lessons.destroy', $lesson) }}" onsubmit="return confirm('Delete this lesson?')">@csrf @method('DELETE')</form>
                                                            </details>
                                                        @endforeach
                                                    </div>

                                                    <details class="mt-3 rounded-xl border border-dashed border-blue-300 bg-blue-50 p-3">
                                                        <summary class="cursor-pointer font-bold text-blue-700">+ Add lesson to {{ $module->title }}</summary>
                                                        <form method="POST" action="{{ route('admin.curriculum.modules.lessons.store', $module) }}" class="mt-3 grid gap-2 md:grid-cols-6">@csrf
                                                            <input name="title" required placeholder="Lesson title" class="rounded-xl border-slate-300 md:col-span-3">
                                                            <input type="number" min="1" name="estimated_minutes" value="10" class="rounded-xl border-slate-300">
                                                            <input type="number" min="0" name="xp_reward" value="10" class="rounded-xl border-slate-300">
                                                            <select name="status" class="rounded-xl border-slate-300"><option value="published">Published</option><option value="draft">Draft</option></select>
                                                            <textarea name="content" rows="3" placeholder="Lesson content" class="rounded-xl border-slate-300 md:col-span-6"></textarea>
                                                            <button class="rounded-xl bg-blue-600 px-4 py-2 font-bold text-white md:col-span-6">Create Lesson</button>
                                                        </form>
                                                    </details>
                                                </div>
                                            @endforeach
                                        </div>

                                        <form method="POST" action="{{ route('admin.curriculum.sections.modules.store', $section) }}" class="mt-4 grid gap-2 md:grid-cols-[1fr_2fr_auto]">@csrf
                                            <input name="title" required placeholder="New module title" class="rounded-xl border-slate-300">
                                            <input name="description" placeholder="Module description" class="rounded-xl border-slate-300">
                                            <button class="rounded-xl bg-indigo-600 px-4 py-2 font-bold text-white">+ Add Module</button>
                                        </form>
                                    </article>
                                @endforeach

                                <form method="POST" action="{{ route('admin.curriculum.courses.sections.store', $course) }}" class="grid gap-2 rounded-2xl border border-dashed border-slate-300 p-4 sm:grid-cols-[100px_1fr_auto]">@csrf
                                    <input name="icon" placeholder="📚" class="rounded-xl border-slate-300">
                                    <input name="name" required placeholder="Vocabulary, Kanji, Grammar..." class="rounded-xl border-slate-300">
                                    <button class="rounded-xl bg-slate-900 px-4 py-2 font-bold text-white">+ Add Section</button>
                                </form>
                            </div>
                        </section>
                    @empty
                        <div class="rounded-3xl bg-white p-10 text-center shadow-sm"><h3 class="text-xl font-black">No courses yet</h3><p class="mt-2 text-slate-500">Create the first course above.</p></div>
                    @endforelse
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
