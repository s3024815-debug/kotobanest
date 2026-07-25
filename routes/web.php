<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AdminLessonController;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\AdminVocabularyController;
use App\Http\Controllers\KanjiController;
use App\Http\Controllers\AdminKanjiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\QuizEngineController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PersonalNoteController;
use App\Http\Controllers\LearningDashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminCurriculumController;
use App\Http\Controllers\PlacementTestController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/premium', 'premium')->name('premium');
Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
Route::get('/vocabulary', [VocabularyController::class, 'index'])->name('vocabulary.index');
Route::get('/kanji', [KanjiController::class, 'index'])->name('kanji.index');
Route::get('/kanji/{kanji}', [KanjiController::class, 'show'])->name('kanji.show');
Route::get('/quiz', [QuizEngineController::class, 'index'])->name('quiz');
Route::post('/quiz', [QuizEngineController::class, 'submit'])->name('quiz.submit');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/placement-test', [PlacementTestController::class, 'index'])->name('placement-test.index');
Route::post('/placement-test', [PlacementTestController::class, 'submit'])->name('placement-test.submit');
Route::get('/placement-test/result', [PlacementTestController::class, 'result'])->name('placement-test.result');
Route::get('/placement-test/skip', [PlacementTestController::class, 'skip'])->name('placement-test.skip');

Route::get('/dictionary', [DictionaryController::class, 'index'])->name('dictionary.index');
Route::get('/dictionary/search', [DictionaryController::class, 'search'])->name('dictionary.search');
Route::get('/dictionary/word', [DictionaryController::class, 'wordDetail'])->name('dictionary.word');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [LearningDashboardController::class, 'index'])->name('dashboard');
    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/notes', [PersonalNoteController::class, 'index'])->name('notes.index');
    Route::post('/notes', [PersonalNoteController::class, 'store'])->name('notes.store');
    Route::delete('/notes/{note}', [PersonalNoteController::class, 'destroy'])->name('notes.destroy');

    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/lessons/{lesson}/complete', [CourseController::class, 'complete'])->name('lessons.complete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/lessons', [AdminLessonController::class, 'index'])->name('lessons');
    Route::post('/lessons', [AdminLessonController::class, 'store'])->name('lessons.store');
    Route::delete('/lessons/{lesson}', [AdminLessonController::class, 'destroy'])->name('lessons.destroy');

    Route::get('/vocabulary', [AdminVocabularyController::class, 'index'])->name('vocabulary');
    Route::post('/vocabulary', [AdminVocabularyController::class, 'store'])->name('vocabulary.store');
    Route::get('/vocabulary/{vocabulary}/edit', [AdminVocabularyController::class, 'edit'])->name('vocabulary.edit');
    Route::put('/vocabulary/{vocabulary}', [AdminVocabularyController::class, 'update'])->name('vocabulary.update');
    Route::delete('/vocabulary/{vocabulary}', [AdminVocabularyController::class, 'destroy'])->name('vocabulary.destroy');

    Route::get('/kanji', [AdminKanjiController::class, 'index'])->name('kanji');
    Route::post('/kanji', [AdminKanjiController::class, 'store'])->name('kanji.store');
    Route::delete('/kanji/{kanji}', [AdminKanjiController::class, 'destroy'])->name('kanji.destroy');

    Route::get('/quiz', [AdminQuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [AdminQuizController::class, 'store'])->name('quiz.store');
    Route::delete('/quiz/{question}', [AdminQuizController::class, 'destroy'])->name('quiz.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/curriculum', [AdminCurriculumController::class, 'index'])->name('curriculum');
    Route::post('/curriculum/courses', [AdminCurriculumController::class, 'storeCourse'])->name('curriculum.courses.store');
    Route::get('/curriculum/courses/{course}', [AdminCurriculumController::class, 'showCourse'])->name('curriculum.courses.show');
    Route::put('/curriculum/courses/{course}', [AdminCurriculumController::class, 'updateCourse'])->name('curriculum.courses.update');
    Route::delete('/curriculum/courses/{course}', [AdminCurriculumController::class, 'destroyCourse'])->name('curriculum.courses.destroy');
    Route::post('/curriculum/courses/{course}/sections', [AdminCurriculumController::class, 'storeSection'])->name('curriculum.courses.sections.store');

    Route::get('/curriculum/sections/{section}', [AdminCurriculumController::class, 'showSection'])->name('curriculum.sections.show');
    Route::put('/curriculum/sections/{section}', [AdminCurriculumController::class, 'updateSection'])->name('curriculum.sections.update');
    Route::delete('/curriculum/sections/{section}', [AdminCurriculumController::class, 'destroySection'])->name('curriculum.sections.destroy');
    Route::post('/curriculum/sections/{section}/modules', [AdminCurriculumController::class, 'storeModule'])->name('curriculum.sections.modules.store');

    Route::get('/curriculum/modules/{module}', [AdminCurriculumController::class, 'showModule'])->name('curriculum.modules.show');
    Route::put('/curriculum/modules/{module}', [AdminCurriculumController::class, 'updateModule'])->name('curriculum.modules.update');
    Route::delete('/curriculum/modules/{module}', [AdminCurriculumController::class, 'destroyModule'])->name('curriculum.modules.destroy');
    Route::post('/curriculum/modules/{module}/lessons', [AdminCurriculumController::class, 'storeLesson'])->name('curriculum.modules.lessons.store');

    Route::get('/curriculum/lessons/{lesson}/edit', [AdminCurriculumController::class, 'editLesson'])->name('curriculum.lessons.edit');
    Route::put('/curriculum/lessons/{lesson}', [AdminCurriculumController::class, 'updateLesson'])->name('curriculum.lessons.update');
    Route::delete('/curriculum/lessons/{lesson}', [AdminCurriculumController::class, 'destroyLesson'])->name('curriculum.lessons.destroy');

    Route::post('/curriculum/move', [AdminCurriculumController::class, 'move'])->name('curriculum.move');
});

require __DIR__.'/auth.php';
