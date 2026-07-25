@php
    $isBulletList = str_starts_with(trim($lesson->content), '・');
    $bullets = $isBulletList ? array_filter(array_map('trim', explode("\n\n", $lesson->content))) : [];
@endphp

@if ($lesson->category === 'Reading')
    <div x-data="readingLesson()" :class="{ 'kb-furigana-on': furiganaOn }">
        <div style="display:flex;gap:.75rem;align-items:center;margin:0 0 1.5rem;flex-wrap:wrap;">
            <button class="kb-btn kb-secondary" @click="furiganaOn = !furiganaOn" x-text="furiganaOn ? 'Hide all furigana' : 'Show all furigana'"></button>
            <span style="font-size:.85rem;color:var(--muted);">Tip: try reading without furigana first. Click any underlined word for its meaning.</span>
        </div>

        <div class="kb-lesson-content" style="font-size:1.3rem;line-height:2.4;" @click="handleClick($event)">
            {!! \App\Support\Furigana::render($lesson->content) !!}
        </div>

        <div x-show="detail" x-cloak @click.self="detail = null"
             style="position:fixed;inset:0;background:rgba(15,23,42,.55);display:flex;align-items:flex-start;justify-content:center;padding:4vh 1rem;overflow-y:auto;z-index:50;">
            <div @click.stop style="background:#fff;border-radius:1.5rem;max-width:520px;width:100%;padding:2rem;box-shadow:var(--shadow);position:relative;">
                <button @click="detail = null" style="position:absolute;top:1rem;right:1.25rem;font-size:1.4rem;color:var(--muted);background:none;border:none;cursor:pointer;">✕</button>
                <template x-if="detailLoading"><p style="color:var(--muted);">Loading…</p></template>
                <template x-if="!detailLoading && detail">
                    <div>
                        <div style="display:flex;align-items:baseline;gap:.75rem;flex-wrap:wrap;">
                            <span style="font-size:2rem;font-weight:900;color:var(--dark);" x-text="detail.word"></span>
                            <span x-show="detail.reading" style="color:var(--muted);font-size:1.1rem;" x-text="detail.reading ? '（' + detail.reading + '）' : ''"></span>
                        </div>
                        <p style="margin-top:.6rem;font-size:1.05rem;" x-text="detail.meaning_en"></p>
                        <template x-if="detail.example">
                            <div style="margin-top:.9rem;background:var(--soft);border-radius:.7rem;padding:.8rem 1rem;">
                                <p style="font-weight:700;color:var(--dark);margin-bottom:.2rem;font-size:.9rem;">Example</p>
                                <p x-text="detail.example" style="font-size:.95rem;"></p>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

@elseif ($lesson->category === 'Vocabulary' && $isBulletList)
    <div class="overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="py-2 pr-4">日本語</th>
                    <th class="py-2 pr-4">読み方</th>
                    <th class="py-2 pr-4">Meaning</th>
                    <th class="py-2">例 (Example)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bullets as $b)
                    @php
                        $lines = explode("\n", $b);
                        $head = ltrim($lines[0] ?? '', '・ ');
                        $example = trim($lines[1] ?? '');
                        preg_match('/^(.*?)（(.*?)） — (.*)$/u', $head, $m);
                    @endphp
                    @if ($m)
                        <tr class="border-b border-slate-50">
                            <td class="py-3 pr-4 text-lg font-bold text-slate-900">{{ $m[1] }}</td>
                            <td class="py-3 pr-4 text-indigo-600 font-semibold">{{ $m[2] }}</td>
                            <td class="py-3 pr-4">{{ $m[3] }}</td>
                            <td class="py-3 text-slate-500">{{ $example }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

@elseif ($lesson->category === 'Kanji' && $isBulletList)
    <div class="grid gap-3 sm:grid-cols-2">
        @foreach ($bullets as $b)
            @php
                $lines = explode("\n", $b);
                $head = ltrim($lines[0] ?? '', '・ ');
                $rest = trim(implode(' ', array_slice($lines, 1)));
                preg_match('/^(.) — (.*)$/u', $head, $m);
            @endphp
            @if ($m)
                <div class="rounded-xl bg-slate-50 p-4 flex gap-3 items-start">
                    <span class="text-3xl font-black text-slate-900">{{ $m[1] }}</span>
                    <div class="text-sm">
                        <p class="font-bold text-slate-800">{{ $m[2] }}</p>
                        <p class="text-slate-400 mt-0.5">{{ $rest }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@else
    <div class="kb-lesson-content">
        @foreach (explode("\n\n", $lesson->content) as $paragraph)
            @php $trimmed = trim($paragraph); @endphp
            @if (str_starts_with($trimmed, '・'))
                @php
                    $lines = explode("\n", $trimmed);
                    $head = ltrim(array_shift($lines), '・ ');
                    $rest = trim(implode(' ', $lines));
                @endphp
                <div style="background:var(--soft);border:1px solid var(--border);border-radius:1rem;padding:1rem 1.25rem;margin:0 0 1em;">
                    <p style="font-weight:800;color:var(--dark);margin:0 0 .3em;font-size:1.15em;">{{ $head }}</p>
                    @if ($rest !== '')
                        <p style="margin:0;color:var(--muted);">{{ $rest }}</p>
                    @endif
                </div>
            @else
                <p style="margin:0 0 1.4em;">{!! nl2br(e($trimmed)) !!}</p>
            @endif
        @endforeach
    </div>
@endif
