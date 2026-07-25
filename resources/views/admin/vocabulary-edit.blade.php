<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            Edit Vocabulary
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-3xl shadow p-8">

                <form method="POST"
                      action="{{ route('admin.vocabulary.update', $vocabulary) }}"
                      class="space-y-5">

                    @csrf
                    @method('PUT')

                    <div>
                        <label class="font-bold">Word</label>
                        <input
                            name="word"
                            value="{{ old('word', $vocabulary->word) }}"
                            class="w-full rounded-xl border-gray-300"
                            required>
                    </div>

                    <div>
                        <label class="font-bold">Furigana</label>
                        <input
                            name="furigana"
                            value="{{ old('furigana', $vocabulary->furigana) }}"
                            class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>
                        <label class="font-bold">English Meaning</label>
                        <input
                            name="meaning_en"
                            value="{{ old('meaning_en', $vocabulary->meaning_en) }}"
                            class="w-full rounded-xl border-gray-300"
                            required>
                    </div>

                    <div>
                        <label class="font-bold">Bangla Meaning</label>
                        <input
                            name="meaning_bn"
                            value="{{ old('meaning_bn', $vocabulary->meaning_bn) }}"
                            class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>
                        <label class="font-bold">Level</label>
                        <select name="level" class="w-full rounded-xl border-gray-300">
                            @foreach(['N5','N4','N3','N2','N1','Daily Life'] as $level)
                                <option value="{{ $level }}"
                                    @selected($vocabulary->level === $level)>
                                    {{ $level }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="font-bold">Category</label>
                        <select name="category" class="w-full rounded-xl border-gray-300">
                            @foreach(['Daily Life','School','Work','Travel','Food','JLPT'] as $category)
                                <option value="{{ $category }}"
                                    @selected($vocabulary->category === $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="font-bold">Status</label>
                        <select name="status" class="w-full rounded-xl border-gray-300">
                            <option value="published"
                                @selected($vocabulary->status === 'published')>
                                Published
                            </option>

                            <option value="draft"
                                @selected($vocabulary->status === 'draft')>
                                Draft
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="font-bold">Example Sentence</label>
                        <textarea
                            name="example"
                            rows="5"
                            class="w-full rounded-xl border-gray-300">{{ old('example', $vocabulary->example) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button class="px-6 py-3 bg-blue-600 text-white rounded-full font-bold">
                            Save Changes
                        </button>

                        <a href="{{ route('admin.vocabulary') }}"
                           class="px-6 py-3 bg-gray-200 text-gray-800 rounded-full font-bold">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>