<?php
namespace App\Http\Controllers;
use App\Models\Kanji; use Illuminate\Http\Request;
class AdminKanjiController extends Controller {
 public function index(){ $kanjis=Kanji::latest()->paginate(10); return view('admin.kanji',compact('kanjis')); }
 public function store(Request $request){ Kanji::create($request->validate(['character'=>['required','string','max:20'],'meaning'=>['required','string','max:255'],'onyomi'=>['nullable','string','max:255'],'kunyomi'=>['nullable','string','max:255'],'stroke_count'=>['nullable','integer','min:1'],'radical'=>['nullable','string','max:50'],'level'=>['required','string','max:50'],'examples'=>['nullable','string'],'status'=>['required','in:published,draft']])); return back()->with('success','Kanji added successfully.'); }
 public function destroy(Kanji $kanji){ $kanji->delete(); return back()->with('success','Kanji deleted successfully.'); }
}
