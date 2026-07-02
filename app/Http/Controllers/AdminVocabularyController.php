<?php
namespace App\Http\Controllers;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
class AdminVocabularyController extends Controller {
    public function index(){
        $vocabularies=Vocabulary::latest()->paginate(10);
        return view('admin.vocabulary',compact('vocabularies'));
    }
    public function store(Request $request){
        Vocabulary::create($request->validate([
            'word'=>['required','string','max:255'],
            'furigana'=>['nullable','string','max:255'],
            'meaning_en'=>['required','string','max:255'],
            'meaning_bn'=>['nullable','string','max:255'],
            'example'=>['nullable','string'],
            'level'=>['required','string','max:50'],
            'category'=>['required','string','max:100'],
            'status'=>['required','in:published,draft'],
        ]));
        return back()->with('success','Vocabulary added successfully.');
    }
    public function destroy(Vocabulary $vocabulary){
        $vocabulary->delete();
        return back()->with('success','Vocabulary deleted successfully.');
    }
}
