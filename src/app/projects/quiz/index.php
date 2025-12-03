<?php
// Basic routing/setup if needed, similar to main index
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quiz App - MJDawson</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Reuse main site styles for consistency -->
    <link rel="stylesheet" href="/assets/reset.css" />
    <link rel="stylesheet" href="/assets/styles.css" />
    <link rel="stylesheet" href="/projects/quiz/styles.css" />
    
    <script>
      // Theme init
      (function() {
        try {
          var saved = localStorage.getItem('theme');
          if (saved === 'light' || saved === 'dark') {
            document.documentElement.setAttribute('data-theme', saved);
          } else {
            var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.setAttribute('data-theme', prefersDark ? 'dark' : 'light');
          }
        } catch (e) {}
      })();
    </script>
</head>
<body>

    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="/">
                <span class="brand-mark">M</span>
                <span class="brand-text">MJDawson</span>
            </a>
            
            <div style="flex:1"></div>

            <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">
                <span class="theme-icon">🌙</span>
            </button>
        </div>
    </header>

    <section class="quiz-section">
        <a href="/" class="back-link">← Back to Home</a>
        
        <div class="quiz-card">
            <!-- Loading State -->
            <div id="loading-state" style="text-align: center; padding: 40px;">
                <p>Loading Quiz...</p>
            </div>

            <!-- Quiz Interface -->
            <div id="quiz-interface" style="display: none;">
                <div class="quiz-header">
                    <h1 class="quiz-title" id="quiz-title">Quiz</h1>
                    <span class="question-count" id="question-count">Question 1/5</span>
                </div>

                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>

                <div id="question-container" class="fade-in">
                    <h2 class="question-text" id="question-text">Question goes here?</h2>
                    <div class="options-grid" id="options-grid">
                        <!-- Options injected here -->
                    </div>
                </div>

                <div class="feedback-area">
                    <button id="next-btn" class="btn primary next-btn">Next Question →</button>
                </div>
            </div>

            <!-- Result Interface -->
            <div id="result-interface" class="result-container">
                <div class="score-circle" id="final-score">0%</div>
                <h2 class="result-message" id="result-message">Great Job!</h2>
                <p class="result-sub" id="result-sub">You scored 0 out of 0</p>
                <div class="cta-row" style="justify-content: center;">
                    <button onclick="location.reload()" class="btn primary">Try Again</button>
                    <a href="/" class="btn ghost">Back Home</a>
                </div>
            </div>
        </div>
    </section>

    <script src="/projects/quiz/script.js"></script>
</body>
</html>
