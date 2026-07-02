<?php
namespace App\Http\Controllers;
use App\Models\Lesson;
use Illuminate\Http\Request;
class LessonController extends Controller {
    public function index(Request $request) {
        $query = Lesson::where('status','published');
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title','like','%'.$request->q.'%')->orWhere('content','like','%'.$request->q.'%');
            });
        }
        if ($request->filled('category')) $query->where('category',$request->category);
        if ($request->filled('level')) $query->where('level',$request->level);
        $lessons = $query->latest()->paginate(9);
        return view('lessons.index', compact('lessons'));
    }
    public function show(Lesson $lesson) {
        abort_if($lesson->status !== 'published', 404);
        return view('lessons.show', compact('lesson'));
    }
}
