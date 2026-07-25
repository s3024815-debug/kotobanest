<?php

namespace App\Console\Commands;

use App\Models\DictionaryEntry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ImportJmdict extends Command
{
    protected $signature = 'dictionary:import {--full : Import the full JMdict (huge) instead of the common-words-only subset}';

    protected $description = 'Download and import the free, open-source JMdict Japanese-English dictionary (via jmdict-simplified)';

    public function handle(): int
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(0);

        $this->info('Looking up the latest jmdict-simplified release on GitHub...');

        $release = Http::withHeaders(['User-Agent' => 'KotobaNest-Importer'])
            ->get('https://api.github.com/repos/scriptin/jmdict-simplified/releases/latest');

        if (! $release->ok()) {
            $this->error('Could not reach GitHub API. Check your internet connection and try again.');
            return self::FAILURE;
        }

        $prefix = $this->option('full') ? 'jmdict-eng-' : 'jmdict-eng-common-';
        $asset = collect($release->json('assets'))
            ->first(fn ($a) => str_starts_with($a['name'], $prefix) && str_ends_with($a['name'], '.json.zip') && ! str_starts_with($a['name'], 'jmdict-examples'));

        if (! $asset) {
            $this->error("Could not find a matching asset ({$prefix}*.json.zip) in the latest release.");
            return self::FAILURE;
        }

        $this->info('Found: '.$asset['name'].' ('.round($asset['size'] / 1024 / 1024, 1).' MB)');

        $dir = storage_path('app/jmdict-import');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $zipPath = $dir.'/'.$asset['name'];

        $this->info('Downloading... this can take a few minutes.');
        $response = Http::withOptions(['sink' => $zipPath])->timeout(600)->get($asset['browser_download_url']);

        if (! $response->ok()) {
            $this->error('Download failed.');
            return self::FAILURE;
        }

        $this->info('Unzipping...');
        $zip = new ZipArchive;
        if ($zip->open($zipPath) !== true) {
            $this->error('Could not open the downloaded zip file. Is the php-zip extension installed?');
            return self::FAILURE;
        }
        $zip->extractTo($dir);
        $jsonName = $zip->getNameIndex(0);
        $zip->close();
        $jsonPath = $dir.'/'.$jsonName;

        $this->info('Reading JSON (this may take a moment for large files)...');
        $data = json_decode(file_get_contents($jsonPath), true);

        if (! $data || empty($data['words'])) {
            $this->error('Could not parse the dictionary JSON file.');
            return self::FAILURE;
        }

        $words = $data['words'];
        $total = count($words);
        $this->info("Parsed {$total} entries. Importing...");

        $bar = $this->output->createProgressBar($total);
        $batch = [];
        $now = now();

        foreach ($words as $word) {
            $kanjiForms = collect($word['kanji'] ?? [])->pluck('text')->values()->all();
            $kanaForms = collect($word['kana'] ?? [])->pluck('text')->values()->all();
            $kanjiText = $kanjiForms[0] ?? null;
            $kanaText = $kanaForms[0] ?? null;
            $mainWord = $kanjiText ?: $kanaText;

            if (! $mainWord) {
                $bar->advance();
                continue;
            }

            $isCommon = ($word['kanji'][0]['common'] ?? false) || ($word['kana'][0]['common'] ?? false);

            $glosses = [];
            $pos = null;
            foreach (($word['sense'] ?? []) as $sense) {
                if ($pos === null && ! empty($sense['partOfSpeech'])) {
                    $pos = implode(', ', $sense['partOfSpeech']);
                }
                foreach (($sense['gloss'] ?? []) as $gloss) {
                    if (($gloss['lang'] ?? 'eng') === 'eng' && ! empty($gloss['text'])) {
                        $glosses[] = $gloss['text'];
                    }
                }
                if (count($glosses) >= 6) {
                    break;
                }
            }

            if (empty($glosses)) {
                $bar->advance();
                continue;
            }

            $batch[] = [
                'jmdict_id' => $word['id'],
                'word' => $mainWord,
                'kanji_forms' => json_encode($kanjiForms),
                'kana_forms' => json_encode($kanaForms),
                'reading' => $kanaText,
                'meaning_en' => implode('; ', array_slice($glosses, 0, 6)),
                'part_of_speech' => $pos,
                'is_common' => $isCommon,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($batch) >= 500) {
                DictionaryEntry::upsert($batch, ['jmdict_id'], ['word', 'kanji_forms', 'kana_forms', 'reading', 'meaning_en', 'part_of_speech', 'is_common', 'updated_at']);
                $batch = [];
            }

            $bar->advance();
        }

        if (! empty($batch)) {
            DictionaryEntry::upsert($batch, ['jmdict_id'], ['word', 'kanji_forms', 'kana_forms', 'reading', 'meaning_en', 'part_of_speech', 'is_common', 'updated_at']);
        }

        $bar->finish();
        $this->newLine(2);

        @unlink($zipPath);
        @unlink($jsonPath);

        $this->info('Done! '.DictionaryEntry::count().' dictionary entries are now in the database.');

        return self::SUCCESS;
    }
}
