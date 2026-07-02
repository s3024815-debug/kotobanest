<?php
namespace App\Http\Controllers;
use App\Models\QuizQuestion; use App\Models\QuizAttempt; use App\Models\UserProgress; use Illuminate\Http\Request;
class QuizEngineController extends Controller{
 public function index(){ $questions=QuizQuestion::where('status','published')->inRandomOrder()->limit(10)->get(); return view('quiz.engine',compact('questions')); }
 public function submit(Request $request){$ids=$request->input('questions',[]);$answers=$request->input('answers',[]);$questions=QuizQuestion::whereIn('id',$ids)->get();$score=0;$review=[];foreach($questions as $q){$ans=$answers[$q->id]??'';$ok=$ans===$q->correct_choice;if($ok)$score++;$review[]=['question'=>$q->question,'answer'=>$ans,'correct'=>$q->correct_choice,'ok'=>$ok,'explanation'=>$q->explanation];}$xp=$score*10;if(auth()->check()){QuizAttempt::create(['user_id'=>auth()->id(),'score'=>$score,'total'=>$questions->count(),'xp_earned'=>$xp]);$p=UserProgress::firstOrCreate(['user_id'=>auth()->id()]);$p->xp += $xp;$p->last_active_date=now()->toDateString();$p->save();}return view('quiz.result',compact('score','xp','review','questions'));}
}
