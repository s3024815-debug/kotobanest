<?php
namespace App\Http\Controllers;
use App\Models\Favorite; use Illuminate\Http\Request;
class FavoriteController extends Controller{public function index(){$favorites=Favorite::where('user_id',auth()->id())->latest()->get();return view('favorites.index',compact('favorites'));} public function store(Request $request){Favorite::firstOrCreate(['user_id'=>auth()->id(),'type'=>$request->type,'item_id'=>$request->item_id],['title'=>$request->title]);return back()->with('success','Added to favorites.');} public function destroy(Favorite $favorite){abort_if($favorite->user_id!==auth()->id(),403);$favorite->delete();return back()->with('success','Removed.');}}
