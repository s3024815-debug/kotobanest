<?php

namespace App\Support;

class Furigana
{
    /**
     * Converts text containing word[reading] markup (e.g. "私[わたし]は学生[がくせい]です")
     * into HTML where each annotated word is a <ruby> tag with a data-word attribute so it
     * can be clicked for a full dictionary lookup, and the <rt> reading is hidden by default
     * (shown when the page's "Show furigana" toggle is on, via the kb-furigana-on class on
     * an ancestor element).
     */
    public static function render(string $text): string
    {
        $pattern = '/([\x{4E00}-\x{9FFF}\x{3400}-\x{4DBF}ー]+)\[([\x{3040}-\x{309F}ー]+)\]/u';

        $html = preg_replace_callback($pattern, function ($m) {
            $word = $m[1];
            $reading = $m[2];

            return '<ruby class="kb-ruby-word" tabindex="0" data-word="'.e($word).'" data-reading="'.e($reading).'">'
                .e($word).'<rt>'.e($reading).'</rt></ruby>';
        }, e($text));

        return nl2br($html, false);
    }
}
