<?php
namespace App\Http\Controllers;
use App\Models\PersonalNote; use Illuminate\Http\Request;
class PersonalNoteController extends Controller{public function index(){$notes=PersonalNote::where('user_id',auth()->id())->latest()->get();return view('notes.index',compact('notes'));} public function store(Request $request){$data=$request->validate(['title'=>['required','max:255'],'body'=>['required'],'type'=>['required']]);$data['user_id']=auth()->id();PersonalNote::create($data);return back()->with('success','Note saved.');} public function destroy(PersonalNote $note){abort_if($note->user_id!==auth()->id(),403);$note->delete();return back()->with('success','Note deleted.');}}
