<?php
namespace App\Http\Controllers;
use App\Models\Lesson; use App\Models\Vocabulary; use App\Models\Kanji; use App\Models\User;
class AdminDashboardController extends Controller {
 public function index(){ $lessonCount=Lesson::count(); $vocabularyCount=Vocabulary::count(); $kanjiCount=Kanji::count(); $userCount=User::count(); return view('admin.dashboard',compact('lessonCount','vocabularyCount','kanjiCount','userCount')); }
}
