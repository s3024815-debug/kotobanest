<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Test - KotobaNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
    <header class="kb-nav">
        <a href="/" class="kb-logo"><span>あ</span>KotobaNest</a>
        <nav class="kb-links">
            @auth
                <a class="kb-login" href="{{ route('placement-test.skip') }}">Skip for now</a>
            @endauth
        </nav>
    </header>

    <main class="kb-section" style="max-width:760px;margin:0 auto;">
        <div class="kb-title">
            <p class="kb-badge">Free Placement Test</p>
            <h2>Let's find your Japanese level</h2>
            <p class="kb-lead">12 quick questions — takes about 3 minutes. We'll recommend the right course to start with.</p>
        </div>

        <form method="POST" action="{{ route('placement-test.submit') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            @foreach ($questions as $i => $q)
                <div style="background:var(--glass);border:1px solid var(--border);border-radius:1.25rem;padding:1.5rem;box-shadow:var(--shadow);">
                    <p style="font-weight:800;color:var(--dark);margin-bottom:1rem;">
                        {{ $i + 1 }}. {{ $q['prompt'] }}
                    </p>
                    <div style="display:grid;gap:.6rem;">
                        @foreach ($q['options'] as $oi => $option)
                            <label style="display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;border:1px solid var(--border);border-radius:.8rem;cursor:pointer;">
                                <input type="radio" name="q{{ $q['id'] }}" value="{{ $oi }}" required>
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit" class="kb-btn kb-primary" style="align-self:center;padding:.9rem 2.5rem;">See My Result →</button>
        </form>
    </main>

    <footer class="kb-footer">© 2026 KotobaNest.</footer>
</body>
</html>
