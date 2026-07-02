<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class QuizQuestion extends Model{protected $fillable=['question','choice_a','choice_b','choice_c','choice_d','correct_choice','explanation','level','category','status'];}
