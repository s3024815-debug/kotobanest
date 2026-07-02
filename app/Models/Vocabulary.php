<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Vocabulary extends Model {
    protected $fillable=['word','furigana','meaning_en','meaning_bn','example','level','category','status'];
}
