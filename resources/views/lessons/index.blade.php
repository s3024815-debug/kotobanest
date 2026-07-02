<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Lessons - KotobaNest</title>@vite(['resources/css/app.css','resources/js/app.js'])</head>
<body class="kb-body">
<header class="kb-nav"><a href="/" class="kb-logo"><span>あ</span>KotobaNest</a><nav class="kb-links"><a href="/">Home</a><a href="{{ route('lessons.index') }}">Lessons</a><a href="{{ route('quiz') }}">Quiz</a>@auth<a class="kb-login" href="{{ route('dashboard') }}">Dashboard</a>@else<a class="kb-login" href="{{ route('login') }}">Login</a>@endauth</nav></header>
<main class="kb-section">
<div class="kb-title"><p class="kb-badge">Japanese Lessons</p><h2>Learn Japanese step by step</h2></div>
<form method="GET" class="kb-filter"><input name="q" value="{{ request('q') }}" placeholder="Search lessons..."><select name="category"><option value="">All Categories</option>@foreach(['Grammar','Vocabulary','Kanji','Conversation','Japan Life'] as $c)<option value="{{ $c }}" @selected(request('category')===$c)>{{ $c }}</option>@endforeach</select><select name="level"><option value="">All Levels</option>@foreach(['N5','N4','N3','N2','N1','Daily Life'] as $l)<option value="{{ $l }}" @selected(request('level')===$l)>{{ $l }}</option>@endforeach</select><button class="kb-btn kb-primary">Search</button></form>
<div class="kb-grid">@forelse($lessons as $lesson)<article class="kb-card"><span>{{ $lesson->level }}</span><h3>{{ $lesson->title }}</h3><p>{{ Str::limit($lesson->content,120) }}</p><p class="kb-tag">{{ $lesson->category }}</p><a href="{{ route('lessons.show',$lesson) }}">Read lesson →</a></article>@empty<div class="kb-card"><h3>No lessons found</h3><p>Add lessons from Admin Lessons page.</p></div>@endforelse</div>
<div class="kb-pagination">{{ $lessons->links() }}</div>
</main><footer class="kb-footer">© 2026 KotobaNest.</footer></body></html>
