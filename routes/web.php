<?php
use App\Http\Controllers\ProfileController; use App\Http\Controllers\LessonController; use App\Http\Controllers\AdminLessonController; use App\Http\Controllers\VocabularyController; use App\Http\Controllers\AdminVocabularyController; use App\Http\Controllers\KanjiController; use App\Http\Controllers\AdminKanjiController; use App\Http\Controllers\AdminDashboardController; use App\Http\Controllers\QuizEngineController; use App\Http\Controllers\AdminQuizController; use App\Http\Controllers\FavoriteController; use App\Http\Controllers\PersonalNoteController; use App\Http\Controllers\LearningDashboardController; use Illuminate\Support\Facades\Route;
Route::view('/','welcome')->name('home');
Route::get('/lessons',[LessonController::class,'index'])->name('lessons.index'); Route::get('/lessons/{lesson}',[LessonController::class,'show'])->name('lessons.show');
Route::get('/vocabulary',[VocabularyController::class,'index'])->name('vocabulary.index');
Route::get('/kanji',[KanjiController::class,'index'])->name('kanji.index'); Route::get('/kanji/{kanji}',[KanjiController::class,'show'])->name('kanji.show');
Route::get('/quiz',[QuizEngineController::class,'index'])->name('quiz'); Route::post('/quiz',[QuizEngineController::class,'submit'])->name('quiz.submit');
Route::get('/dashboard',[LearningDashboardController::class,'index'])->middleware(['auth','verified'])->name('dashboard');
Route::middleware(['auth'])->group(function(){
Route::get('/favorites',[FavoriteController::class,'index'])->name('favorites.index'); Route::post('/favorites',[FavoriteController::class,'store'])->name('favorites.store'); Route::delete('/favorites/{favorite}',[FavoriteController::class,'destroy'])->name('favorites.destroy');
Route::get('/notes',[PersonalNoteController::class,'index'])->name('notes.index'); Route::post('/notes',[PersonalNoteController::class,'store'])->name('notes.store'); Route::delete('/notes/{note}',[PersonalNoteController::class,'destroy'])->name('notes.destroy');
Route::get('/admin',[AdminDashboardController::class,'index'])->name('admin.dashboard');
Route::get('/admin/lessons',[AdminLessonController::class,'index'])->name('admin.lessons'); Route::post('/admin/lessons',[AdminLessonController::class,'store'])->name('admin.lessons.store'); Route::delete('/admin/lessons/{lesson}',[AdminLessonController::class,'destroy'])->name('admin.lessons.destroy');
Route::get('/admin/vocabulary',[AdminVocabularyController::class,'index'])->name('admin.vocabulary'); Route::post('/admin/vocabulary',[AdminVocabularyController::class,'store'])->name('admin.vocabulary.store'); Route::delete('/admin/vocabulary/{vocabulary}',[AdminVocabularyController::class,'destroy'])->name('admin.vocabulary.destroy');
Route::get('/admin/kanji',[AdminKanjiController::class,'index'])->name('admin.kanji'); Route::post('/admin/kanji',[AdminKanjiController::class,'store'])->name('admin.kanji.store'); Route::delete('/admin/kanji/{kanji}',[AdminKanjiController::class,'destroy'])->name('admin.kanji.destroy');
Route::get('/admin/quiz',[AdminQuizController::class,'index'])->name('admin.quiz'); Route::post('/admin/quiz',[AdminQuizController::class,'store'])->name('admin.quiz.store'); Route::delete('/admin/quiz/{question}',[AdminQuizController::class,'destroy'])->name('admin.quiz.destroy');
Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit'); Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update'); Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
