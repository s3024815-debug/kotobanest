<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium - KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
    <header class="kb-nav">
        <a href="/" class="kb-logo"><span>あ</span>KotobaNest</a>
        <nav class="kb-links">
            <a href="{{ route('lessons.index') }}">Lessons</a>
            <a href="{{ route('quiz') }}">Quiz</a>
            @auth
                <a class="kb-login" href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a class="kb-login" href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </header>

    <main class="kb-section" style="max-width:720px;margin:0 auto;text-align:center;">
        <p class="kb-badge">Premium — Coming Soon</p>
        <h2 style="font-size:2.2rem;">Go further with KotobaNest Premium</h2>
        <p class="kb-lead">We're finishing the N3–N1 curriculum and the payment system. Here's what Premium will include once it launches:</p>

        <div style="text-align:left;background:var(--glass);border:1px solid var(--border);border-radius:1.5rem;padding:2rem;box-shadow:var(--shadow);margin:2rem 0;display:grid;gap:.9rem;">
            <div>✓ Full N3, N2, and N1 grammar, vocabulary, and kanji paths</div>
            <div>✓ Downloadable lesson notes (PDF)</div>
            <div>✓ Larger quiz banks with detailed explanations</div>
            <div>✓ Priority access to new content as it's released</div>
        </div>

        <p style="color:var(--muted);margin-bottom:1.5rem;">Price hasn't been finalized yet. Leave your email and we'll let you know the moment Premium is ready.</p>

        <form method="GET" action="{{ route('register') }}" style="display:flex;gap:.75rem;justify-content:center;flex-wrap:wrap;">
            @auth
                <a class="kb-btn kb-primary" href="{{ route('dashboard') }}">Keep Learning Free →</a>
            @else
                <a class="kb-btn kb-primary" href="{{ route('register') }}">Create Free Account →</a>
            @endauth
            <a class="kb-btn kb-secondary" href="{{ route('courses.index') }}">See What's Free Now</a>
        </form>
    </main>

    <footer class="kb-footer">© 2026 KotobaNest.</footer>
</body>
</html>
