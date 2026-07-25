<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlacementTestController extends Controller
{
    /**
     * Each question: id, level (weight follows level), prompt, options, answer index.
     */
    public static function questions(): array
    {
        return [
            ['id' => 1, 'level' => 'N5', 'weight' => 1, 'prompt' => 'これは＿＿＿です。（This is a book.）', 'options' => ['本', '山', '水', '川'], 'answer' => 0],
            ['id' => 2, 'level' => 'N5', 'weight' => 1, 'prompt' => '私＿＿＿学生です。', 'options' => ['を', 'に', 'は', 'で'], 'answer' => 2],
            ['id' => 3, 'level' => 'N5', 'weight' => 1, 'prompt' => 'What does 大きい mean?', 'options' => ['Small', 'Big', 'New', 'Old'], 'answer' => 1],
            ['id' => 4, 'level' => 'N5', 'weight' => 1, 'prompt' => '水を＿＿＿。（I drink water.）', 'options' => ['食べます', '見ます', '飲みます', '読みます'], 'answer' => 2],
            ['id' => 5, 'level' => 'N4', 'weight' => 2, 'prompt' => 'Potential form of 話す (to speak) is:', 'options' => ['話せる', '話した', '話して', '話そう'], 'answer' => 0],
            ['id' => 6, 'level' => 'N4', 'weight' => 2, 'prompt' => '食べている means:', 'options' => ['Will eat', 'Ate', 'Is eating', 'Wants to eat'], 'answer' => 2],
            ['id' => 7, 'level' => 'N4', 'weight' => 2, 'prompt' => 'What does 経験 mean?', 'options' => ['Experience', 'Environment', 'Economy', 'Explanation'], 'answer' => 0],
            ['id' => 8, 'level' => 'N4', 'weight' => 2, 'prompt' => '安ければ、買います means:', 'options' => ['I bought it because it was cheap', 'If it is cheap, I will buy it', 'It is not cheap, so I will not buy it', 'I want to buy something cheap'], 'answer' => 1],
            ['id' => 9, 'level' => 'N3', 'weight' => 3, 'prompt' => '食べたばかりです means:', 'options' => ['I am about to eat', 'I want to eat', 'I just ate', 'I never eat'], 'answer' => 2],
            ['id' => 10, 'level' => 'N3', 'weight' => 3, 'prompt' => '＿＿＿のに, meaning "even though", is used to show:', 'options' => ['A reason', 'A contrast/unexpected result', 'A condition', 'A request'], 'answer' => 1],
            ['id' => 11, 'level' => 'N3', 'weight' => 3, 'prompt' => '行くことにしました means:', 'options' => ['It was decided that (someone) goes', 'I decided to go', 'I am going now', 'I used to go'], 'answer' => 1],
            ['id' => 12, 'level' => 'N3', 'weight' => 3, 'prompt' => '＿＿＿させていただきます is a very polite way to say:', 'options' => ['Please let me do (this)', 'Please do (this) for me', 'I will never do (this)', 'You must do (this)'], 'answer' => 0],
        ];
    }

    public function index(): View
    {
        return view('placement-test.index', ['questions' => self::questions()]);
    }

    public function submit(Request $request): RedirectResponse
    {
        $questions = self::questions();
        $score = 0;
        $maxScore = 0;

        foreach ($questions as $q) {
            $maxScore += $q['weight'];
            $given = $request->input('q'.$q['id']);
            if ($given !== null && (int) $given === $q['answer']) {
                $score += $q['weight'];
            }
        }

        $percent = $maxScore > 0 ? round(($score / $maxScore) * 100) : 0;

        if ($score <= 6) {
            $level = 'N5';
        } elseif ($score <= 14) {
            $level = 'N4';
        } else {
            $level = 'N3';
        }

        if (auth()->check()) {
            auth()->user()->update([
                'placement_test_completed_at' => now(),
                'placement_test_result' => $level,
                'current_jlpt' => $level,
            ]);
        }

        return redirect()->route('placement-test.result', ['level' => $level, 'score' => $score, 'max' => $maxScore, 'percent' => $percent]);
    }

    public function result(Request $request): View
    {
        $level = in_array($request->query('level'), ['N5', 'N4', 'N3']) ? $request->query('level') : 'N5';
        $recommendedLevel = $level === 'N3' ? 'N4' : $level;
        $course = Course::where('level', $recommendedLevel)->first();

        return view('placement-test.result', [
            'estimatedLevel' => $level,
            'recommendedLevel' => $recommendedLevel,
            'course' => $course,
            'score' => (int) $request->query('score', 0),
            'max' => (int) $request->query('max', 24),
            'percent' => (int) $request->query('percent', 0),
        ]);
    }

    public function skip(): RedirectResponse
    {
        if (auth()->check()) {
            auth()->user()->update(['placement_test_completed_at' => now()]);
        }

        return redirect()->route('dashboard');
    }
}
