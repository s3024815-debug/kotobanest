<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Kanji;
use App\Models\Vocabulary;
use Illuminate\Database\Seeder;

/**
 * Fills the Course > Section > Module > Lesson curriculum tree with the real
 * N5/N4 vocabulary, kanji and grammar content from N5N4CurriculumSeeder,
 * and marks everything else (Reading/Listening on all levels, and
 * Vocabulary/Kanji/Grammar on N3/N2/N1) as "Coming Soon" instead of leaving
 * the generic scaffold placeholder text.
 *
 * Run AFTER CourseCurriculumSeeder and N5N4CurriculumSeeder.
 */
class FillCurriculumContentSeeder extends Seeder
{
    private array $vocabModules = ['Core Words', 'Daily Life', 'Review & Practice'];
    private array $kanjiModules = ['Core Characters', 'Readings & Compounds', 'Review & Practice'];
    private array $grammarModules = ['Core Patterns', 'Sentence Building', 'Review & Practice'];

    public function run(): void
    {
        $this->fillVocabulary('N5');
        $this->fillVocabulary('N4');
        $this->fillKanji('N5');
        $this->fillKanji('N4');
        $this->fillGrammar('N5');
        $this->fillGrammar('N4');
        $this->markComingSoon();
        $this->fillSampleReading();
        $this->scaleTimeAndXp();
    }

    private function moduleLessons(string $level, string $section, string $moduleTitle)
    {
        $course = Course::where('level', $level)->first();
        if (! $course) {
            return collect();
        }

        return Lesson::whereHas('module.section', function ($q) use ($course, $section) {
            $q->where('course_id', $course->id)->where('name', $section);
        })->whereHas('module', fn ($q) => $q->where('title', $moduleTitle))
            ->orderBy('position')
            ->get();
    }

    private function chunk(array $items, int $parts): array
    {
        $size = (int) ceil(count($items) / $parts);
        return array_chunk($items, max($size, 1));
    }

    private function fillVocabulary(string $level): void
    {
        $words = Vocabulary::where('level', $level)->orderBy('id')->get()->all();
        $chunks = $this->chunk($words, 9);
        $idx = 0;

        foreach ($this->vocabModules as $moduleTitle) {
            $lessons = $this->moduleLessons($level, 'Vocabulary', $moduleTitle)->take(3);
            foreach ($lessons as $i => $lesson) {
                $items = $chunks[$idx] ?? [];
                $idx++;
                if (empty($items)) {
                    continue;
                }
                $theme = collect($items)->countBy('category')->sortDesc()->keys()->first();
                $content = collect($items)->map(fn ($v) => "・{$v->word}（{$v->furigana}） — {$v->meaning_en}\n  {$v->example}")->implode("\n\n");
                $lesson->update([
                    'title' => "{$moduleTitle} Lesson ".($i + 1).": {$theme}",
                    'content' => $content,
                ]);
            }
        }
    }

    private function fillKanji(string $level): void
    {
        $kanji = Kanji::where('level', $level)->orderBy('id')->get()->all();
        $chunks = $this->chunk($kanji, 9);
        $idx = 0;

        foreach ($this->kanjiModules as $moduleTitle) {
            $lessons = $this->moduleLessons($level, 'Kanji', $moduleTitle)->take(3);
            foreach ($lessons as $i => $lesson) {
                $items = $chunks[$idx] ?? [];
                $idx++;
                if (empty($items)) {
                    continue;
                }
                $content = collect($items)->map(fn ($k) => "・{$k->character} — {$k->meaning}\n  On'yomi: ".($k->onyomi ?: '—')."　Kun'yomi: ".($k->kunyomi ?: '—')."　Strokes: {$k->stroke_count}\n  {$k->examples}")->implode("\n\n");
                $lesson->update([
                    'title' => "{$moduleTitle} Lesson ".($i + 1),
                    'content' => $content,
                ]);
            }
        }
    }

    private function fillGrammar(string $level): void
    {
        $grammarLessons = $level === 'N5' ? N5N4CurriculumSeeder::n5GrammarLessons() : N5N4CurriculumSeeder::n4GrammarLessons();

        $slots = [];
        foreach ($this->grammarModules as $moduleTitle) {
            $lessons = $this->moduleLessons($level, 'Grammar', $moduleTitle)->take(3);
            foreach ($lessons as $lesson) {
                $slots[] = $lesson;
            }
        }

        for ($i = 0; $i < 8 && $i < count($slots); $i++) {
            [$title, , , $content] = $grammarLessons[$i];
            $slots[$i]->update(['title' => $title, 'content' => $content]);
        }

        if (isset($slots[8])) {
            $recap = "Great work getting through the {$level} grammar path! Here's everything you've covered so far:\n\n"
                .collect($grammarLessons)->take(8)->map(fn ($l, $i) => ($i + 1).". {$l[0]}")->implode("\n")
                ."\n\nGo back to any lesson above to review, or head to the Vocabulary and Kanji sections to keep building your foundation.";
            $slots[8]->update(['title' => 'Review & Practice Lesson 3: Grammar Recap', 'content' => $recap]);
        }
    }

    private function fillSampleReading(): void
    {
        $lesson = $this->moduleLessons('N5', 'Reading', 'Short Texts')->first();
        if (! $lesson) {
            return;
        }

        $content = "はじめまして。私[わたし]は田中[たなか]です。学生[がくせい]です。\n\n"
            ."大学[だいがく]で日本語[にほんご]を勉強[べんきょう]しています。毎日[まいにち]電車[でんしゃ]で学校[がっこう]に行[い]きます。\n\n"
            ."週末[しゅうまつ]は友達[ともだち]と映画[えいが]を見[み]ます。日本[にほん]の食[た]べ物[もの]が大好[だいす]きです。\n\n"
            ."どうぞよろしくお願[ねが]いします。";

        $lesson->update([
            'title' => 'Short Texts Lesson 1: Self Introduction',
            'content' => $content,
        ]);
    }

    private function scaleTimeAndXp(): void
    {
        $scaling = ['N5' => 10, 'N4' => 15, 'N3' => 20, 'N2' => 25, 'N1' => 30];

        foreach ($scaling as $level => $minutes) {
            $course = Course::where('level', $level)->first();
            if (! $course) {
                continue;
            }

            Lesson::whereHas('module.section', fn ($q) => $q->where('course_id', $course->id))
                ->update(['estimated_minutes' => $minutes, 'xp_reward' => $minutes]);
        }
    }

    private function markComingSoon(): void
    {
        Lesson::whereHas('module.section.course', function ($q) {
            $q->whereNotIn('level', ['N5', 'N4']);
        })->orWhereHas('module.section', function ($q) {
            $q->whereIn('name', ['Reading', 'Listening']);
        })->get()->each(function (Lesson $lesson) {
            if (str_contains($lesson->title, '(Coming Soon)')) {
                return;
            }
            $level = $lesson->module?->section?->course?->level ?? $lesson->level;
            $section = $lesson->module?->section?->name ?? $lesson->category;
            $lesson->update([
                'title' => "{$lesson->title} (Coming Soon)",
                'content' => "This ".strtolower($section)." lesson for {$level} is still being written and will be added soon. In the meantime, check out the {$level} Vocabulary, Kanji, and Grammar lessons if they're ready, or explore other levels.",
            ]);
        });
    }
}
