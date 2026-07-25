<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Result - KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
    <header class="kb-nav">
        <a href="/" class="kb-logo"><span>あ</span>KotobaNest</a>
    </header>

    <main class="kb-section" style="max-width:640px;margin:0 auto;text-align:center;">
        <p class="kb-badge">Your Result</p>
        <h2 style="font-size:2.2rem;margin-bottom:.25rem;">You scored {{ $percent }}%</h2>
        <p class="kb-lead">Estimated level: <strong>{{ $estimatedLevel }}</strong></p>

        <div style="background:var(--glass);border:1px solid var(--border);border-radius:1.5rem;padding:2rem;box-shadow:var(--shadow);margin:2rem 0;">
            @if ($estimatedLevel === 'N3')
                <p style="font-weight:800;color:var(--dark);margin-bottom:.5rem;">Impressive! Your Japanese is already around N3 level or beyond.</p>
                <p style="color:var(--muted);margin-bottom:1.5rem;">Our N3–N1 courses are still being built, so for now we recommend the <strong>N4</strong> course to lock in your fundamentals while we finish the advanced material.</p>
            @else
                <p style="font-weight:800;color:var(--dark);margin-bottom:.5rem;">We recommend starting with the <strong>{{ $recommendedLevel }}</strong> course.</p>
                <p style="color:var(--muted);margin-bottom:1.5rem;">This matches where you are right now — you'll move at the right pace without feeling lost or bored.</p>
            @endif

            @if ($course)
                <a class="kb-btn kb-primary" href="{{ route('courses.show', $course) }}">Start {{ $recommendedLevel }} Course →</a>
            @else
                <a class="kb-btn kb-primary" href="{{ route('courses.index') }}">Browse Courses →</a>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" style="color:var(--muted);font-weight:600;">Skip to Dashboard →</a>
    </main>

    <footer class="kb-footer">© 2026 KotobaNest.</footer>
</body>
</html>
