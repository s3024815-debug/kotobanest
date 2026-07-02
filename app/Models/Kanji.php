<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Kanji extends Model {
 protected $fillable=['character','meaning','onyomi','kunyomi','stroke_count','radical','level','examples','status'];
}
