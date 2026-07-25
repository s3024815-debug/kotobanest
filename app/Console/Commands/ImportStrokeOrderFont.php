<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportStrokeOrderFont extends Command
{
    protected $signature = 'font:import-stroke-order';

    protected $description = 'Download the free, open-source KanjiStrokeOrders font used to show kanji writing/stroke order (kakikata)';

    /**
     * A few known mirrors of the same free font, tried in order until one works.
     */
    private array $mirrors = [
        'https://raw.githubusercontent.com/jensechu/kanji/master/fonts/KanjiStrokeOrders.ttf',
        'https://raw.githubusercontent.com/KDE/kiten/master/data/font/KanjiStrokeOrders.ttf',
    ];

    public function handle(): int
    {
        $destDir = public_path('fonts');
        if (! is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }
        $destPath = $destDir.'/KanjiStrokeOrders.ttf';

        foreach ($this->mirrors as $url) {
            $this->info("Trying {$url} ...");
            try {
                $response = Http::withOptions(['sink' => $destPath])->timeout(120)->get($url);
            } catch (\Throwable $e) {
                $this->warn('Failed: '.$e->getMessage());
                continue;
            }

            if ($response->ok() && filesize($destPath) > 100000) {
                $this->info('Downloaded to public/fonts/KanjiStrokeOrders.ttf ('.round(filesize($destPath) / 1024 / 1024, 1).' MB)');
                $this->info('Done! Kanji pages will now show a "Show stroke order" toggle.');

                return self::SUCCESS;
            }

            @unlink($destPath);
        }

        $this->error('Could not download the font from any known mirror. Check your internet connection and try again later.');

        return self::FAILURE;
    }
}
