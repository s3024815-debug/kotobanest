<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserProgress extends Model{protected $fillable=['user_id','xp','streak','current_level','lessons_completed','vocabulary_learned','kanji_learned','last_active_date'];}
