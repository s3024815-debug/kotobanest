<?php
namespace App\Http\Controllers;
use App\Models\Kanji; use Illuminate\Http\Request;
class KanjiController extends Controller {
 public function index(Request $request) {
  $query=Kanji::where('status','published');
  if($request->filled('q')){$query->where(function($q) use($request){$q->where('character','like','%'.$request->q.'%')->orWhere('meaning','like','%'.$request->q.'%')->orWhere('onyomi','like','%'.$request->q.'%')->orWhere('kunyomi','like','%'.$request->q.'%')->orWhere('examples','like','%'.$request->q.'%');});}
  if($request->filled('level')) $query->where('level',$request->level);
  $kanjis=$query->latest()->paginate(12); return view('kanji.index',compact('kanjis'));
 }
 public function show(Kanji $kanji){ abort_if($kanji->status!=='published',404); return view('kanji.show',compact('kanji')); }
}
