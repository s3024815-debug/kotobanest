<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-indigo-600">KotobaNest Learning Path</p>
            <h2 class="text-2xl font-black text-slate-900">Choose your course</h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <section class="mb-8 rounded-3xl bg-gradient-to-r from-indigo-600 to-violet-600 p-7 text-white shadow-xl">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-indigo-100">Simple learning dashboard</p>
                <h1 class="mt-2 text-3xl font-black sm:text-4xl">Select one level, then one category</h1>
                <p class="mt-3 max-w-3xl text-indigo-100">Only the selected course is shown, so N5–N1 will no longer appear together.</p>
            </section>

            <section class="mb-8 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="grid gap-4 lg:grid-cols-[1fr_240px]">
                    <label>
                        <span class="mb-2 block text-sm font-black text-slate-700">Search course or category</span>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">⌕</span>
                            <input id="courseSearch" type="search" placeholder="Search N5, Kanji, Grammar..." class="w-full rounded-2xl border-slate-200 py-3 pl-11 pr-4 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </label>

                    <label>
                        <span class="mb-2 block text-sm font-black text-slate-700">JLPT level</span>
                        <select id="levelSelect" class="w-full rounded-2xl border-slate-200 py-3 focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($courses as $course)
                                <option value="{{ $course->level }}">{{ $course->level }} · {{ $course->title }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </section>

            <div class="mb-6 flex gap-3 overflow-x-auto pb-2" id="categoryTabs">
                <button type="button" data-category="all" class="category-tab whitespace-nowrap rounded-full bg-slate-900 px-5 py-3 text-sm font-black text-white">All sections</button>
                <button type="button" data-category="vocabulary" class="category-tab whitespace-nowrap rounded-full bg-white px-5 py-3 text-sm font-black text-slate-600 shadow-sm">📖 Vocabulary</button>
                <button type="button" data-category="kanji" class="category-tab whitespace-nowrap rounded-full bg-white px-5 py-3 text-sm font-black text-slate-600 shadow-sm">🈶 Kanji</button>
                <button type="button" data-category="grammar" class="category-tab whitespace-nowrap rounded-full bg-white px-5 py-3 text-sm font-black text-slate-600 shadow-sm">✍️ Grammar</button>
                <button type="button" data-category="reading" class="category-tab whitespace-nowrap rounded-full bg-white px-5 py-3 text-sm font-black text-slate-600 shadow-sm">📚 Reading</button>
                <button type="button" data-category="listening" class="category-tab whitespace-nowrap rounded-full bg-white px-5 py-3 text-sm font-black text-slate-600 shadow-sm">🎧 Listening</button>
            </div>

            <div id="courseResults" class="space-y-6">
                @foreach ($courses as $course)
                    @php $isEnrolled = in_array($course->id, $enrolledIds, true); @endphp
                    <article
                        class="course-panel hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm"
                        data-level="{{ strtolower($course->level) }}"
                        data-search="{{ strtolower($course->level.' '.$course->title.' '.$course->description.' '.$course->sections->pluck('name')->join(' ')) }}"
                    >
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                            <div class="max-w-3xl">
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-black text-indigo-700">{{ $course->level }}</span>
                                    <span class="text-2xl">{{ $isEnrolled ? '🔓' : '🔒' }}</span>
                                </div>
                                <h2 class="mt-4 text-3xl font-black text-slate-900">{{ $course->title }}</h2>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $course->description }}</p>
                            </div>

                            <div class="w-full lg:w-52">
                                @auth
                                    @if ($isEnrolled)
                                        <a href="{{ route('courses.show', $course) }}" class="block rounded-2xl bg-slate-900 px-5 py-3 text-center font-bold text-white">Continue course</a>
                                    @else
                                        <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                            @csrf
                                            <button class="w-full rounded-2xl bg-indigo-600 px-5 py-3 font-bold text-white hover:bg-indigo-700">Unlock {{ $course->level }}</button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="block rounded-2xl bg-indigo-600 px-5 py-3 text-center font-bold text-white">Login to unlock</a>
                                @endauth
                            </div>
                        </div>

                        <div class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
                            @foreach ($course->sections as $section)
                                <a
                                    href="{{ route('courses.show', $course) }}#section-{{ $section->slug }}"
                                    class="section-card rounded-2xl border border-slate-200 bg-slate-50 p-4 transition hover:-translate-y-1 hover:border-indigo-300 hover:bg-indigo-50"
                                    data-category="{{ strtolower($section->slug) }}"
                                    data-name="{{ strtolower($section->name) }}"
                                >
                                    <div class="text-3xl">{{ $section->icon }}</div>
                                    <h3 class="mt-3 font-black text-slate-900">{{ $section->name }}</h3>
                                    <p class="mt-1 text-xs text-slate-500">Open {{ $section->name }} lessons</p>
                                </a>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>

            <div id="emptyState" class="hidden rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <div class="text-5xl">🔎</div>
                <h3 class="mt-4 text-xl font-black text-slate-900">Nothing found</h3>
                <p class="mt-2 text-slate-500">Try another level, category or search word.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const levelSelect = document.getElementById('levelSelect');
            const searchInput = document.getElementById('courseSearch');
            const tabs = [...document.querySelectorAll('.category-tab')];
            const panels = [...document.querySelectorAll('.course-panel')];
            const emptyState = document.getElementById('emptyState');
            let selectedCategory = 'all';

            function normalise(value) {
                return (value || '').toLowerCase().trim();
            }

            function render() {
                const selectedLevel = normalise(levelSelect.value);
                const query = normalise(searchInput.value);
                let visiblePanels = 0;

                panels.forEach(panel => {
                    const levelMatches = panel.dataset.level === selectedLevel;
                    const searchMatches = !query || panel.dataset.search.includes(query);
                    const cards = [...panel.querySelectorAll('.section-card')];
                    let visibleCards = 0;

                    cards.forEach(card => {
                        const categoryMatches = selectedCategory === 'all' || card.dataset.category.includes(selectedCategory);
                        const cardSearchMatches = !query || card.dataset.name.includes(query) || panel.dataset.search.includes(query);
                        const showCard = categoryMatches && cardSearchMatches;
                        card.classList.toggle('hidden', !showCard);
                        if (showCard) visibleCards++;
                    });

                    const showPanel = levelMatches && searchMatches && visibleCards > 0;
                    panel.classList.toggle('hidden', !showPanel);
                    if (showPanel) visiblePanels++;
                });

                emptyState.classList.toggle('hidden', visiblePanels > 0);
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    selectedCategory = tab.dataset.category;
                    tabs.forEach(item => {
                        const active = item === tab;
                        item.classList.toggle('bg-slate-900', active);
                        item.classList.toggle('text-white', active);
                        item.classList.toggle('bg-white', !active);
                        item.classList.toggle('text-slate-600', !active);
                    });
                    render();
                });
            });

            levelSelect.addEventListener('change', render);
            searchInput.addEventListener('input', render);
            render();
        });
    </script>
</x-app-layout>
