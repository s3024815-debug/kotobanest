<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryEntry extends Model
{
    protected $fillable = [
        'jmdict_id', 'word', 'kanji_forms', 'kana_forms', 'reading', 'meaning_en', 'part_of_speech', 'is_common',
    ];

    protected $casts = [
        'is_common' => 'boolean',
        'kanji_forms' => 'array',
        'kana_forms' => 'array',
    ];
}
