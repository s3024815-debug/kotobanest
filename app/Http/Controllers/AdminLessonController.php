<?php
namespace App\Http\Controllers;
use App\Models\Lesson;
use Illuminate\Http\Request;
class AdminLessonController extends Controller {
    public function index() {
        $lessons = Lesson::latest()->paginate(10);
        return view('admin.lessons', compact('lessons'));
    }
    public function store(Request $request) {
        Lesson::create($request->validate([
            'title'=>['required','string','max:255'],
            'category'=>['required','string','max:100'],
            'level'=>['required','string','max:50'],
            'content'=>['required','string'],
            'status'=>['required','in:published,draft'],
        ]));
        return back()->with('success','Lesson published successfully.');
    }
    public function destroy(Lesson $lesson) {
        $lesson->delete();
        return back()->with('success','Lesson deleted successfully.');
    }
}
