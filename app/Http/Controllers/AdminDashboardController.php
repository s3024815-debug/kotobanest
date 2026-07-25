<?php

namespace App\Http\Controllers;

use App\Models\Kanji;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\User;
use App\Models\UserProgress;
use App\Models\Vocabulary;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $since = now()->subDays(30);

        $stats = [
            'users' => $this->statCard('Total Users', User::count(), User::where('created_at', '>=', $since)->count()),
            'lessons' => $this->statCard('Total Lessons', Lesson::count(), Lesson::where('created_at', '>=', $since)->count()),
            'vocabulary' => $this->statCard('Total Vocabulary', Vocabulary::count(), Vocabulary::where('created_at', '>=', $since)->count()),
            'kanji' => $this->statCard('Total Kanji', Kanji::count(), Kanji::where('created_at', '>=', $since)->count()),
            'completions' => $this->statCard('Lessons Completed', LessonCompletion::count(), LessonCompletion::where('created_at', '>=', $since)->count()),
        ];

        $growth = collect(range(6, 0))->map(function ($daysAgo) {
            $day = now()->subDays($daysAgo);
            return [
                'label' => $day->format('M j'),
                'total' => User::where('created_at', '<=', $day->endOfDay())->count(),
            ];
        })->values();

        $recentActivity = collect()
            ->merge(User::latest()->take(5)->get()->map(fn ($u) => [
                'icon' => 'user', 'color' => 'purple',
                'title' => 'New user registered',
                'detail' => $u->name.' joined',
                'at' => $u->created_at,
            ]))
            ->merge(Lesson::latest()->take(5)->get()->map(fn ($l) => [
                'icon' => 'book', 'color' => 'blue',
                'title' => 'New lesson created',
                'detail' => 'Lesson "'.$l->title.'" added',
                'at' => $l->created_at,
            ]))
            ->merge(Vocabulary::latest()->take(5)->get()->map(fn ($v) => [
                'icon' => 'word', 'color' => 'green',
                'title' => 'New vocabulary added',
                'detail' => 'Word "'.$v->word.'" added',
                'at' => $v->created_at,
            ]))
            ->merge(Kanji::latest()->take(5)->get()->map(fn ($k) => [
                'icon' => 'kanji', 'color' => 'orange',
                'title' => 'New kanji added',
                'detail' => 'Kanji "'.$k->character.'" added',
                'at' => $k->created_at,
            ]))
            ->merge(LessonCompletion::with(['user', 'lesson'])->latest()->take(5)->get()->map(fn ($c) => [
                'icon' => 'quiz', 'color' => 'red',
                'title' => 'Lesson completed',
                'detail' => ($c->user->name ?? 'A user').' finished "'.($c->lesson->title ?? 'a lesson').'"',
                'at' => $c->created_at,
            ]))
            ->filter(fn ($item) => $item['at'] !== null)
            ->sortByDesc('at')
            ->take(6)
            ->values();

        $topLessons = Lesson::withCount('completions')
            ->orderByDesc('completions_count')
            ->take(5)
            ->get();

        $recentUsers = User::latest()->take(5)->get();

        $xpLeaderboard = UserProgress::with('user')
            ->orderByDesc('xp')
            ->take(5)
            ->get()
            ->filter(fn ($p) => $p->user !== null)
            ->values();

        return view('admin.dashboard', compact(
            'stats', 'growth', 'recentActivity', 'topLessons', 'recentUsers', 'xpLeaderboard'
        ));
    }

    private function statCard(string $label, int $total, int $recent): array
    {
        $base = max($total - $recent, 0);
        $change = $base > 0 ? round(($recent / $base) * 100, 1) : ($total > 0 ? 100 : 0);

        return [
            'label' => $label,
            'total' => $total,
            'change' => $change,
        ];
    }
}
