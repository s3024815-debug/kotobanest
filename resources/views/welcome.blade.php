<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KotobaNest - Learn Japanese Smarter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kb-body">
    <header class="kb-nav">
        <a href="/" class="kb-logo">
            <span>あ</span>
            KotobaNest
        </a>

        <nav class="kb-links">
            <a href="{{ route('courses.index') }}">Courses</a>
            <a href="{{ route('lessons.index') }}">Lessons</a>
            <a href="{{ route('dictionary.index') }}">Dictionary</a>
            <a href="{{ route('quiz') }}">Quiz</a>
            <a href="{{ route('premium') }}">Pricing</a>
            @auth
                <a class="kb-login" href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a class="kb-login" href="{{ route('register') }}">Start Free</a>
            @endauth
        </nav>
    </header>

    <main>
        <section class="kb-hero-v2">
            <div class="kb-glow kb-glow-one"></div>
            <div class="kb-glow kb-glow-two"></div>

            <div class="kb-hero-copy">
                <p class="kb-badge">日本語をやさしく学ぼう</p>
                <h1>Master Japanese with confidence.</h1>
                <p class="kb-lead">
                    From hiragana to real grammar, vocabulary, and kanji — KotobaNest helps you build a real N5–N4 foundation with structured, honest content. No filler, no fake lessons.
                </p>

                <div class="kb-actions">
                    @auth
                        <a class="kb-btn kb-primary" href="{{ route('dashboard') }}">Continue Learning</a>
                    @else
                        <a class="kb-btn kb-primary" href="{{ route('register') }}">Start Learning Free →</a>
                    @endauth
                    <a class="kb-btn kb-secondary" href="{{ route('placement-test.index') }}">Take a Level Test</a>
                </div>

                <div class="kb-trust-row">
                    <div><strong>N5 → N1</strong><span>JLPT roadmap</span></div>
                    <div><strong>3 min</strong><span>Free level test</span></div>
                    <div><strong>Real content</strong><span>No filler lessons</span></div>
                </div>
            </div>

            <div class="kb-hero-visual">
                <div class="kb-floating-card card-one">
                    <span>文法</span>
                    <b>Grammar</b>
                    <small>Particles, patterns, examples</small>
                </div>

                <div class="kb-word-main">
                    <p>Word of the Day</p>
                    <h2>言葉</h2>
                    <b>ことば / kotoba</b>
                    <span>Word / Language</span>
                    <div class="kb-example">日本語の言葉を勉強します。</div>
                </div>

                <div class="kb-floating-card card-two">
                    <span>漢字</span>
                    <b>Kanji</b>
                    <small>Meaning, reading, stroke order</small>
                </div>
            </div>
        </section>

        <section class="kb-section">
            <div class="kb-feature-row">
                <div>
                    <div class="kb-feature-icon" style="background:#fee2e2;">📖</div>
                    <h4>Structured Curriculum</h4>
                    <p>Lessons organized by level, unlocked one at a time.</p>
                </div>
                <div>
                    <div class="kb-feature-icon" style="background:#dcfce7;">辞</div>
                    <h4>Live Dictionary</h4>
                    <p>Instant lookup with thousands of real entries.</p>
                </div>
                <div>
                    <div class="kb-feature-icon" style="background:#ede9fe;">漢</div>
                    <h4>Kanji + Stroke Order</h4>
                    <p>Meaning, readings, and how to write each kanji.</p>
                </div>
                <div>
                    <div class="kb-feature-icon" style="background:#fef3c7;">📈</div>
                    <h4>Track Your Progress</h4>
                    <p>XP, streaks, and course completion — all real.</p>
                </div>
            </div>
        </section>

        @if ($continue)
            <section class="kb-section">
                <div class="kb-title" style="text-align:left;margin-bottom:1rem;">
                    <p class="kb-badge">Continue Your Journey</p>
                    <h2 style="font-size:1.6rem;">Pick up where you left off</h2>
                </div>
                <div class="kb-continue-card">
                    <div class="kb-continue-thumb">{{ $continue['course']->level }}</div>
                    <div style="flex:1;min-width:0;">
                        <span class="kb-badge" style="margin:0 0 4px;">In Progress</span>
                        <p style="font-weight:800;margin:2px 0;">{{ $continue['lesson']->title }}</p>
                        <p style="color:var(--muted);font-size:.85rem;margin:0 0 6px;">{{ $continue['lesson']->category }}</p>
                        <div style="height:6px;background:var(--border);border-radius:99px;overflow:hidden;max-width:220px;">
                            <div style="height:100%;background:var(--blue);width:{{ $continue['percent'] }}%"></div>
                        </div>
                    </div>
                    <a class="kb-btn kb-primary" href="{{ route('lessons.show', $continue['lesson']) }}">Continue</a>
                </div>
            </section>
        @endif

        <section class="kb-section" id="path">
            <div class="kb-title">
                <p class="kb-badge">Find Your Path</p>
                <h2>Courses crafted for every JLPT level</h2>
            </div>

            <div class="kb-grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));">
                @foreach ($courses as $c)
                    <a class="kb-course-card" href="{{ route('courses.show', $c['course']) }}">
                        <div class="kb-course-banner" style="background:linear-gradient(135deg,var(--blue),var(--violet));">
                            <span class="kb-course-tag">{{ $c['course']->level }}</span>
                        </div>
                        <div class="kb-course-body">
                            <h3>{{ $c['course']->title }}</h3>
                            <p>{{ $c['course']->description }}</p>
                            <div class="kb-course-meta">{{ $c['lessonCount'] }} Lessons</div>
                        </div>
                    </a>
                @endforeach
                <a class="kb-course-card" href="{{ route('placement-test.index') }}">
                    <div class="kb-course-banner" style="background:linear-gradient(135deg,#f59e0b,#ec4899);">
                        <span class="kb-course-tag">Free</span>
                    </div>
                    <div class="kb-course-body">
                        <h3>Not sure where to start?</h3>
                        <p>Take our 3-minute placement test and get a course recommendation.</p>
                        <div class="kb-course-meta">12 Questions</div>
                    </div>
                </a>
            </div>
        </section>

        <div class="kb-section" style="padding-top:0;">
            <div class="kb-stats-bar">
                <div><b>{{ $stats['lessons'] }}</b><span>Real Lessons</span></div>
                <div><b>{{ $stats['vocabulary'] }}</b><span>Vocabulary Words</span></div>
                <div><b>{{ $stats['kanji'] }}</b><span>Kanji Covered</span></div>
                <div><b>{{ $stats['courses'] }}</b><span>Full Courses (N5 & N4)</span></div>
            </div>
        </div>

        <section class="kb-section" id="features">
            <div class="kb-title">
                <p class="kb-badge">Why KotobaNest?</p>
                <h2>Built for serious Japanese learners</h2>
            </div>

            <div class="kb-feature-grid">
                <div>✓ Furigana-friendly reading lessons</div>
                <div>✓ JLPT-ready structure, N5 to N1</div>
                <div>✓ Kanji stroke order (kakikata)</div>
                <div>✓ Live dictionary with real entries</div>
                <div>✓ Daily quiz practice</div>
                <div>✓ Mobile-friendly design</div>
            </div>
        </section>

        <section class="kb-section" id="pricing">
            <div class="kb-title">
                <p class="kb-badge">Simple Pricing</p>
                <h2>Start free. Upgrade when you're ready.</h2>
            </div>

            <div class="kb-grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));">
                <div class="kb-card" style="cursor:default;">
                    <span>🎓</span>
                    <h3>Free</h3>
                    <p>Full access to N5 & N4 lessons, vocabulary, kanji, quizzes, dictionary, and the placement test.</p>
                    <p style="font-weight:800;color:var(--dark);font-size:1.4rem;margin-top:.5rem;">৳0</p>
                </div>
                <a class="kb-card" href="{{ route('premium') }}" style="border:2px solid var(--violet);">
                    <span>✨</span>
                    <h3>Premium <small style="font-weight:600;color:var(--muted);">(Coming Soon)</small></h3>
                    <p>Full N3–N1 path, downloadable notes, and priority new content as it's released.</p>
                    <p style="font-weight:800;color:var(--dark);font-size:1.4rem;margin-top:.5rem;">Price TBA</p>
                </a>
            </div>
        </section>

        <section class="kb-cta-v2">
            <h2>Start your Japanese journey today.</h2>
            <p>KotobaNest is your home for lessons, vocabulary, kanji, quizzes, and a live dictionary.</p>
            @auth
                <a class="kb-btn kb-white" href="{{ route('dashboard') }}">Open Dashboard</a>
            @else
                <a class="kb-btn kb-white" href="{{ route('register') }}">Create Free Account</a>
            @endauth
        </section>
    </main>

    <footer class="kb-footer">
        <div>
            <b>KotobaNest</b>
            <p>Your Home for Japanese Learning.</p>
        </div>
        <div class="kb-footer-links">
            <a href="{{ route('courses.index') }}">Courses</a>
            <a href="{{ route('lessons.index') }}">Lessons</a>
            <a href="{{ route('dictionary.index') }}">Dictionary</a>
            <a href="{{ route('quiz') }}">Quiz</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </footer>
</body>
</html>
