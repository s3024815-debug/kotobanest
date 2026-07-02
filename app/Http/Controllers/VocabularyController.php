<?php
namespace App\Http\Controllers;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
class VocabularyController extends Controller {
    public function index(Request $request) {
        $query=Vocabulary::where('status','published');
        if($request->filled('q')){
            $query->where(function($q) use($request){
                $q->where('word','like','%'.$request->q.'%')
                  ->orWhere('furigana','like','%'.$request->q.'%')
                  ->orWhere('meaning_en','like','%'.$request->q.'%')
                  ->orWhere('meaning_bn','like','%'.$request->q.'%');
            });
        }
        if($request->filled('level')) $query->where('level',$request->level);
        if($request->filled('category')) $query->where('category',$request->category);
        $vocabularies=$query->latest()->paginate(12);
        return view('vocabulary.index',compact('vocabularies'));
    }
}
