<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary - KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
    <header class="kb-nav">
        <a href="/" class="kb-logo"><span>あ</span>KotobaNest</a>
        <nav class="kb-links">
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

    <main class="kb-section" style="max-width:820px;margin:0 auto;"
          x-data="kotobaDictionary()">
        <div class="kb-title">
            <p class="kb-badge">Live Dictionary</p>
            <h2>Look up any word or kanji instantly</h2>
            <p class="kb-lead">Search in English, romaji, or Japanese — click any result to see full details.</p>
        </div>

        <div style="position:relative;margin-bottom:2rem;">
            <input
                type="text"
                x-model="q"
                @input.debounce.250ms="search()"
                placeholder="Try 食べる, taberu, eat, or খাওয়া..."
                autofocus
                style="width:100%;padding:1rem 1.25rem;border-radius:1rem;border:1px solid var(--border);font-size:1.05rem;box-shadow:var(--shadow);"
            >
            <span x-show="loading" style="position:absolute;right:1.25rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.85rem;">Searching…</span>
        </div>

        <template x-if="vocabulary.length > 0">
            <div style="margin-bottom:2rem;">
                <h3 style="font-weight:800;color:var(--dark);margin-bottom:1rem;">Vocabulary</h3>
                <div style="display:grid;gap:.9rem;">
                    <template x-for="v in vocabulary" :key="'v'+v.id">
                        <div @click="openWord(v.word)" style="cursor:pointer;background:var(--glass);border:1px solid var(--border);border-radius:1rem;padding:1.1rem 1.4rem;box-shadow:var(--shadow);transition:transform .12s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                            <div style="display:flex;align-items:baseline;gap:.6rem;flex-wrap:wrap;">
                                <span style="font-size:1.4rem;font-weight:900;color:var(--dark);" x-text="v.word"></span>
                                <span style="color:var(--muted);" x-text="'（' + v.furigana + '）'"></span>
                                <span class="kb-badge" style="margin:0;" x-text="v.level"></span>
                            </div>
                            <p style="margin:.4rem 0 0;" x-text="v.meaning_en"></p>
                            <p style="margin:.3rem 0 0;color:var(--muted);font-size:.92rem;" x-text="v.example"></p>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        <template x-if="kanji.length > 0">
            <div style="margin-bottom:2rem;">
                <h3 style="font-weight:800;color:var(--dark);margin-bottom:1rem;">Kanji</h3>
                <div style="display:grid;gap:.9rem;">
                    <template x-for="k in kanji" :key="'k'+k.id">
                        <div @click="openWord(k.character)" style="cursor:pointer;background:var(--glass);border:1px solid var(--border);border-radius:1rem;padding:1.1rem 1.4rem;box-shadow:var(--shadow);display:flex;gap:1rem;align-items:flex-start;">
                            <span style="font-size:2.2rem;font-weight:900;color:var(--dark);" x-text="k.character"></span>
                            <div>
                                <div style="display:flex;gap:.5rem;align-items:baseline;flex-wrap:wrap;">
                                    <span style="font-weight:700;" x-text="k.meaning"></span>
                                    <span class="kb-badge" style="margin:0;" x-text="k.level"></span>
                                </div>
                                <p style="margin:.3rem 0 0;color:var(--muted);font-size:.9rem;" x-text="'On: ' + (k.onyomi || '—') + '　Kun: ' + (k.kunyomi || '—') + '　Strokes: ' + k.stroke_count"></p>
                                <p style="margin:.3rem 0 0;color:var(--muted);font-size:.9rem;" x-text="k.examples"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        <template x-if="general.length > 0">
            <div style="margin-top:1rem;">
                <h3 style="font-weight:800;color:var(--dark);margin-bottom:1rem;">More Results</h3>
                <div style="display:grid;gap:.6rem;">
                    <template x-for="g in general" :key="'g'+g.id">
                        <div @click="openWord(g.word)" style="cursor:pointer;background:var(--soft);border:1px solid var(--border);border-radius:.8rem;padding:.8rem 1.2rem;">
                            <div style="display:flex;align-items:baseline;gap:.6rem;flex-wrap:wrap;">
                                <span style="font-weight:800;color:var(--dark);" x-text="g.word"></span>
                                <span x-show="g.reading" style="color:var(--muted);font-size:.9rem;" x-text="g.reading ? '（' + g.reading + '）' : ''"></span>
                                <span x-show="g.part_of_speech" style="color:var(--violet);font-size:.78rem;font-weight:700;" x-text="g.part_of_speech"></span>
                            </div>
                            <p style="margin:.2rem 0 0;font-size:.92rem;" x-text="g.meaning_en"></p>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        <template x-if="!loading && q.length > 0 && vocabulary.length === 0 && kanji.length === 0 && general.length === 0">
            <p style="text-align:center;color:var(--muted);">No matches for "<span x-text="q"></span>". Try a different word.</p>
        </template>

        <template x-if="q.length === 0">
            <p style="text-align:center;color:var(--muted);">
                Start typing above to search {{ \App\Models\Vocabulary::count() }} words and {{ \App\Models\Kanji::count() }} kanji
                @if (\App\Models\DictionaryEntry::count() > 0)
                    , plus {{ number_format(\App\Models\DictionaryEntry::count()) }} full dictionary entries
                @endif
                .
            </p>
        </template>

        <!-- Word detail modal -->
        <div x-show="detail" x-cloak @click.self="detail = null"
             style="position:fixed;inset:0;background:rgba(15,23,42,.55);display:flex;align-items:flex-start;justify-content:center;padding:4vh 1rem;overflow-y:auto;z-index:50;">
            <div @click.stop style="background:#fff;border-radius:1.5rem;max-width:640px;width:100%;padding:2rem;box-shadow:var(--shadow);position:relative;">
                <button @click="detail = null" style="position:absolute;top:1rem;right:1.25rem;font-size:1.4rem;color:var(--muted);background:none;border:none;cursor:pointer;">✕</button>

                <template x-if="detailLoading">
                    <p style="color:var(--muted);">Loading…</p>
                </template>

                <template x-if="!detailLoading && detail">
                    <div>
                        <div style="display:flex;align-items:baseline;gap:.75rem;flex-wrap:wrap;">
                            <span style="font-size:2.4rem;font-weight:900;color:var(--dark);" x-text="detail.word"></span>
                            <span x-show="detail.reading" style="color:var(--muted);font-size:1.2rem;" x-text="detail.reading ? '（' + detail.reading + '）' : ''"></span>
                            <span x-show="detail.part_of_speech" style="color:var(--violet);font-weight:700;font-size:.85rem;" x-text="detail.part_of_speech"></span>
                        </div>

                        <p style="margin-top:.75rem;font-size:1.1rem;" x-text="detail.meaning_en"></p>

                        <template x-if="detail.example">
                            <div style="margin-top:1rem;background:var(--soft);border-radius:.8rem;padding:.9rem 1.1rem;">
                                <p style="font-weight:700;color:var(--dark);margin-bottom:.2rem;">Example sentence</p>
                                <p x-text="detail.example"></p>
                            </div>
                        </template>

                        <template x-if="(detail.kanji_forms && detail.kanji_forms.length > 1) || (detail.kana_forms && detail.kana_forms.length > 1)">
                            <div style="margin-top:1rem;">
                                <p style="font-weight:700;color:var(--dark);margin-bottom:.3rem;">Alternative writings</p>
                                <p style="color:var(--muted);">
                                    <span x-text="(detail.kanji_forms || []).join('、 ')"></span>
                                    <span x-show="detail.kanji_forms && detail.kanji_forms.length && detail.kana_forms && detail.kana_forms.length"> ・ </span>
                                    <span x-text="(detail.kana_forms || []).join('、 ')"></span>
                                </p>
                            </div>
                        </template>

                        <template x-if="detail.kanji_breakdown && detail.kanji_breakdown.length > 0">
                            <div style="margin-top:1.25rem;">
                                <p style="font-weight:700;color:var(--dark);margin-bottom:.6rem;">Kanji in this word</p>
                                <div style="display:grid;gap:.7rem;">
                                    <template x-for="kb in detail.kanji_breakdown" :key="kb.character">
                                        <div x-data="{ stroke: false }" style="display:flex;gap:.9rem;align-items:flex-start;background:var(--soft);border-radius:.8rem;padding:.8rem 1rem;">
                                            <span :class="{ 'kb-stroke-font': stroke }" :style="stroke ? 'font-size:5rem;line-height:1;' : 'font-size:1.8rem;'" style="font-weight:900;color:var(--dark);cursor:pointer;" @click="stroke = !stroke" :title="stroke ? 'Click to hide stroke order' : 'Click to see stroke order'" x-text="kb.character"></span>
                                            <div>
                                                <p style="font-weight:700;" x-text="kb.meaning"></p>
                                                <p style="color:var(--muted);font-size:.85rem;margin:.1rem 0 0;" x-text="'On: ' + (kb.onyomi || '—') + '　Kun: ' + (kb.kunyomi || '—') + '　Strokes: ' + kb.stroke_count"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </main>

    <footer class="kb-footer">© 2026 KotobaNest.</footer>

    <script>
        function kotobaDictionary() {
            return {
                q: '',
                vocabulary: [],
                kanji: [],
                general: [],
                loading: false,
                detail: null,
                detailLoading: false,
                async search() {
                    if (this.q.trim().length === 0) {
                        this.vocabulary = [];
                        this.kanji = [];
                        this.general = [];
                        return;
                    }
                    this.loading = true;
                    try {
                        const res = await fetch(`{{ route('dictionary.search') }}?q=${encodeURIComponent(this.q)}`);
                        const data = await res.json();
                        this.vocabulary = data.vocabulary;
                        this.kanji = data.kanji;
                        this.general = data.general;
                    } catch (e) {
                        this.vocabulary = [];
                        this.kanji = [];
                        this.general = [];
                    } finally {
                        this.loading = false;
                    }
                },
                async openWord(word) {
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
</body>
</html>
