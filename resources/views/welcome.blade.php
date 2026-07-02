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
            <a href="{{ route('lessons.index') }}">Lessons</a>
            <a href="{{ route('quiz') }}">Quiz</a>
            <a href="#path">JLPT</a>
            <a href="#features">Features</a>
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
                <h1>Learn Japanese smarter, faster, and beautifully.</h1>
                <p class="kb-lead">
                    KotobaNest helps you learn Japanese from zero to JLPT with lessons, vocabulary, kanji, quizzes, and AI-ready practice.
                </p>

                <div class="kb-actions">
                    @auth
                        <a class="kb-btn kb-primary" href="{{ route('dashboard') }}">Continue Learning</a>
                    @else
                        <a class="kb-btn kb-primary" href="{{ route('register') }}">Start Learning Free</a>
                    @endauth
                    <a class="kb-btn kb-secondary" href="{{ route('quiz') }}">Try Daily Quiz</a>
                </div>

                <div class="kb-trust-row">
                    <div><strong>12,500+</strong><span>Learners goal</span></div>
                    <div><strong>N5 → N1</strong><span>JLPT roadmap</span></div>
                    <div><strong>AI Ready</strong><span>Future teacher</span></div>
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
                    <small>Meaning, reading, usage</small>
                </div>
            </div>
        </section>

        <section class="kb-section" id="path">
            <div class="kb-title">
                <p class="kb-badge">JLPT Learning Path</p>
                <h2>Move step by step from beginner to advanced</h2>
            </div>

            <div class="kb-path">
                <div><b>N5</b><span>First step</span></div>
                <div><b>N4</b><span>Daily basics</span></div>
                <div><b>N3</b><span>Intermediate</span></div>
                <div><b>N2</b><span>Advanced</span></div>
                <div><b>N1</b><span>Mastery</span></div>
            </div>
        </section>

        <section class="kb-section">
            <div class="kb-title">
                <p class="kb-badge">Popular Lessons</p>
                <h2>Choose how you want to learn today</h2>
            </div>

            <div class="kb-grid">
                <a class="kb-card" href="{{ route('lessons.index') }}?category=Grammar">
                    <span>文</span>
                    <h3>Grammar</h3>
                    <p>Simple explanations for particles, sentence patterns, and JLPT grammar.</p>
                </a>
                <a class="kb-card" href="{{ route('lessons.index') }}?category=Vocabulary">
                    <span>語</span>
                    <h3>Vocabulary</h3>
                    <p>Daily useful words with reading, meaning, and example sentences.</p>
                </a>
                <a class="kb-card" href="{{ route('lessons.index') }}?category=Kanji">
                    <span>漢</span>
                    <h3>Kanji</h3>
                    <p>Learn kanji with meaning, onyomi, kunyomi, and practice examples.</p>
                </a>
                <a class="kb-card" href="{{ route('quiz') }}">
                    <span>Q</span>
                    <h3>Daily Quiz</h3>
                    <p>Practice quickly every day and build your learning streak.</p>
                </a>
                <a class="kb-card" href="{{ route('lessons.index') }}?category=Conversation">
                    <span>会</span>
                    <h3>Conversation</h3>
                    <p>Useful Japanese phrases for school, job, shopping, and daily life.</p>
                </a>
                <a class="kb-card" href="{{ route('lessons.index') }}?category=Japan Life">
                    <span>🇯🇵</span>
                    <h3>Japan Life</h3>
                    <p>Japanese for konbini, station, university, part-time jobs, and documents.</p>
                </a>
            </div>
        </section>

        <section class="kb-section kb-preview">
            <div>
                <p class="kb-badge">Vocabulary Preview</p>
                <h2>Learn words in a clean, memorable way</h2>
                <p class="kb-lead">
                    Vocabulary will become the core of KotobaNest: words, furigana, meaning, examples, favorites, and audio later.
                </p>
            </div>

            <div class="kb-vocab-list">
                <div><h3>言葉</h3><p>ことば</p><span>Word / Language</span></div>
                <div><h3>勉強</h3><p>べんきょう</p><span>Study</span></div>
                <div><h3>学校</h3><p>がっこう</p><span>School</span></div>
            </div>
        </section>

        <section class="kb-section" id="features">
            <div class="kb-title">
                <p class="kb-badge">Why KotobaNest?</p>
                <h2>Built for serious Japanese learners</h2>
            </div>

            <div class="kb-feature-grid">
                <div>✓ Furigana-friendly lessons</div>
                <div>✓ JLPT-ready structure</div>
                <div>✓ Daily quiz practice</div>
                <div>✓ Progress tracking ready</div>
                <div>✓ AI teacher ready</div>
                <div>✓ Mobile-first design</div>
            </div>
        </section>

        <section class="kb-cta-v2">
            <h2>Start your Japanese journey today.</h2>
            <p>KotobaNest is your home for lessons, vocabulary, kanji, quizzes, and Japan life learning.</p>
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
            <a href="{{ route('lessons.index') }}">Lessons</a>
            <a href="{{ route('quiz') }}">Quiz</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </footer>
</body>
</html>
