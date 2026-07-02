<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KotobaNest - Master Japanese with Confidence</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
<header class="kb-nav">
<a href="/" class="kb-logo"><span>あ</span>KotobaNest</a>
<nav class="kb-links">
<a href="{{ route('lessons.index') }}">Lessons</a>
<a href="{{ route('vocabulary.index') }}">Vocabulary</a>
<a href="{{ route('kanji.index') }}">Kanji</a>
<a href="{{ route('quiz') }}">Quiz</a>
@auth
<a class="kb-login" href="{{ route('dashboard') }}">Dashboard</a>
@else
<a href="{{ route('login') }}">Login</a>
<a class="kb-login" href="{{ route('register') }}">Start Free</a>
@endauth
</nav>
</header>

<main>
<section class="kb-home-hero">
<div class="kb-hero-left">
<p class="kb-badge">Japanese Learning Platform</p>
<h1>Master Japanese with Confidence.</h1>
<p class="kb-lead">Learn vocabulary, kanji, grammar, and JLPT practice through one modern learning platform built for serious learners.</p>
<div class="kb-actions">
@auth
<a class="kb-btn kb-primary" href="{{ route('dashboard') }}">Continue Learning</a>
@else
<a class="kb-btn kb-primary" href="{{ route('register') }}">Start Learning</a>
@endauth
<a class="kb-btn kb-secondary" href="{{ route('lessons.index') }}">Explore Lessons</a>
</div>
<div class="kb-home-stats">
<div><b>500+</b><span>Lessons Ready</span></div>
<div><b>3000+</b><span>Vocabulary Goal</span></div>
<div><b>2000+</b><span>Kanji Goal</span></div>
</div>
</div>

<div class="kb-hero-right">
<div class="kb-japanese-card">
<p>Today’s Focus</p>
<h2>学</h2>
<b>ガク / まなぶ</b>
<span>Study / Learning</span>
</div>
<div class="kb-small-card one">📚 Lessons</div>
<div class="kb-small-card two">📝 Smart Quiz</div>
<div class="kb-small-card three">🔥 XP + Streak</div>
</div>
</section>

<section class="kb-section">
<div class="kb-title">
<p class="kb-badge">Core Features</p>
<h2>Everything you need in one clean system</h2>
</div>
<div class="kb-grid">
<a class="kb-card" href="{{ route('lessons.index') }}"><span>📚</span><h3>Interactive Lessons</h3><p>Learn grammar, conversation, and Japan-life topics step by step.</p></a>
<a class="kb-card" href="{{ route('vocabulary.index') }}"><span>🈶</span><h3>Vocabulary Builder</h3><p>Study Japanese words with furigana, meaning, and examples.</p></a>
<a class="kb-card" href="{{ route('kanji.index') }}"><span>漢</span><h3>Kanji Explorer</h3><p>Understand kanji readings, meanings, radicals, and examples.</p></a>
<a class="kb-card" href="{{ route('quiz') }}"><span>📝</span><h3>Smart Quiz</h3><p>Practice questions and improve score with XP tracking.</p></a>
<a class="kb-card" href="{{ route('dashboard') }}"><span>📊</span><h3>Progress Dashboard</h3><p>Track XP, streak, quiz history, notes, and favorites.</p></a>
<div class="kb-card"><span>🤖</span><h3>AI Teacher</h3><p>Coming soon: explanations, correction, and conversation practice.</p></div>
</div>
</section>

<section class="kb-section">
<div class="kb-title">
<p class="kb-badge">JLPT Roadmap</p>
<h2>From N5 basics to N1 mastery</h2>
</div>
<div class="kb-roadmap">
<div><b>N5</b><span>Beginner</span></div>
<div><b>N4</b><span>Daily Japanese</span></div>
<div><b>N3</b><span>Intermediate</span></div>
<div><b>N2</b><span>Advanced</span></div>
<div><b>N1</b><span>Mastery</span></div>
</div>
</section>

<section class="kb-section kb-split">
<div>
<p class="kb-badge">Built for learners in Japan</p>
<h2>Study Japanese for school, work, and real life.</h2>
<p class="kb-lead">KotobaNest is designed for international students and learners who need practical Japanese, JLPT preparation, and daily-life communication.</p>
</div>
<div class="kb-review-box">
<h3>“A clean platform for serious Japanese study.”</h3>
<p>Lessons, vocabulary, kanji, quiz, and progress are connected in one place.</p>
<b>— KotobaNest Vision</b>
</div>
</section>

<section class="kb-cta-v2">
<h2>Start your Japanese journey today.</h2>
<p>Build your vocabulary, master kanji, practice quizzes, and track your progress.</p>
@auth
<a class="kb-btn kb-white" href="{{ route('dashboard') }}">Open Dashboard</a>
@else
<a class="kb-btn kb-white" href="{{ route('register') }}">Create Free Account</a>
@endauth
</section>
</main>

<footer class="kb-footer">
<div><b>KotobaNest</b><p>Your home for Japanese learning.</p></div>
<div class="kb-footer-links">
<a href="{{ route('lessons.index') }}">Lessons</a>
<a href="{{ route('vocabulary.index') }}">Vocabulary</a>
<a href="{{ route('kanji.index') }}">Kanji</a>
<a href="{{ route('quiz') }}">Quiz</a>
</div>
</footer>
</body>
</html>
