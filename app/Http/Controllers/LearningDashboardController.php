<?php
namespace App\Http\Controllers;
use App\Models\UserProgress; use App\Models\QuizAttempt; use App\Models\Favorite; use App\Models\PersonalNote;
class LearningDashboardController extends Controller{public function index(){$progress=UserProgress::firstOrCreate(['user_id'=>auth()->id()]);$attempts=QuizAttempt::where('user_id',auth()->id())->latest()->limit(5)->get();$favoriteCount=Favorite::where('user_id',auth()->id())->count();$noteCount=PersonalNote::where('user_id',auth()->id())->count();return view('dashboard.learning',compact('progress','attempts','favoriteCount','noteCount'));}}
