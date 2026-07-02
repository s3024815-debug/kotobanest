<?php
namespace App\Http\Controllers;
use App\Models\QuizQuestion; use Illuminate\Http\Request;
class AdminQuizController extends Controller{
 public function index(){ $questions=QuizQuestion::latest()->paginate(10); return view('admin.quiz',compact('questions')); }
 public function store(Request $request){QuizQuestion::create($request->validate(['question'=>['required'],'choice_a'=>['required'],'choice_b'=>['required'],'choice_c'=>['required'],'choice_d'=>['nullable'],'correct_choice'=>['required','in:A,B,C,D'],'explanation'=>['nullable'],'level'=>['required'],'category'=>['required'],'status'=>['required','in:published,draft']]));return back()->with('success','Quiz question added.');}
 public function destroy(QuizQuestion $question){$question->delete();return back()->with('success','Question deleted.');}
}
