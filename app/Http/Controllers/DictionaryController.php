<?php

namespace App\Http\Controllers;

use App\Models\Kanji;
use App\Models\Vocabulary;
use App\Models\DictionaryEntry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DictionaryController extends Controller
{
    public function index(): View
    {
        return view('dictionary.index');
    }

    public function search(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));

        if ($q === '' || mb_strlen($q) < 1) {
            return response()->json(['vocabulary' => [], 'kanji' => []]);
        }

        $vocabulary = Vocabulary::where('status', 'published')
            ->where(function ($query) use ($q) {
                $query->where('word', 'like', "%{$q}%")
                    ->orWhere('furigana', 'like', "%{$q}%")
                    ->orWhere('meaning_en', 'like', "%{$q}%")
                    ->orWhere('meaning_bn', 'like', "%{$q}%");
            })
            ->orderBy('word')
            ->limit(15)
            ->get(['id', 'word', 'furigana', 'meaning_en', 'meaning_bn', 'example', 'level', 'category']);

        $kanji = Kanji::where('status', 'published')
            ->where(function ($query) use ($q) {
                $query->where('character', 'like', "%{$q}%")
                    ->orWhere('meaning', 'like', "%{$q}%")
                    ->orWhere('onyomi', 'like', "%{$q}%")
                    ->orWhere('kunyomi', 'like', "%{$q}%");
            })
            ->orderBy('character')
            ->limit(15)
            ->get(['id', 'character', 'meaning', 'onyomi', 'kunyomi', 'stroke_count', 'level', 'examples']);

        $general = DictionaryEntry::where(function ($query) use ($q) {
                $query->where('word', 'like', "%{$q}%")
                    ->orWhere('reading', 'like', "%{$q}%")
                    ->orWhere('meaning_en', 'like', "%{$q}%");
            })
            ->orderByDesc('is_common')
            ->orderBy('word')
            ->limit(20)
            ->get(['id', 'word', 'kanji_forms', 'kana_forms', 'reading', 'meaning_en', 'part_of_speech']);

        return response()->json([
            'vocabulary' => $vocabulary,
            'kanji' => $kanji,
            'general' => $general,
        ]);
    }

    /**
     * Full detail panel for a single word: readings/alternative forms,
     * meaning, an example sentence if we have one, and a per-character
     * kanji breakdown (meaning, onyomi, kunyomi, stroke count) for any
     * kanji in the word that we have in our own Kanji table.
     */
    public function wordDetail(Request $request): JsonResponse
    {
        $word = trim((string) $request->query('word', ''));

        if ($word === '') {
            return response()->json(['error' => 'No word given'], 422);
        }

        $vocab = Vocabulary::where('word', $word)->first();
        $entry = DictionaryEntry::where('word', $word)->orderByDesc('is_common')->first();

        $characters = collect(mb_str_split($word))->unique()->values();
        $kanjiBreakdown = Kanji::whereIn('character', $characters)
            ->get(['character', 'meaning', 'onyomi', 'kunyomi', 'stroke_count', 'examples']);

        return response()->json([
            'word' => $word,
            'reading' => $vocab->furigana ?? $entry->reading ?? null,
            'kanji_forms' => $entry->kanji_forms ?? [],
            'kana_forms' => $entry->kana_forms ?? [],
            'meaning_en' => $vocab->meaning_en ?? $entry->meaning_en ?? null,
            'meaning_bn' => $vocab->meaning_bn ?? null,
            'part_of_speech' => $entry->part_of_speech ?? null,
            'example' => $vocab->example ?? null,
            'kanji_breakdown' => $kanjiBreakdown,
        ]);
    }
}
