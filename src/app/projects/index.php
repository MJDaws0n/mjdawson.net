<?php
require_once dirname(__FILE__).'/../../../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="color-scheme" content="dark light" />
    <meta name="description" content="All Projects — MJDawson. A collection of my work, experiments, and tools." />
    <meta property="og:title" content="Projects — MJDawson" />
    <meta property="og:description" content="Explore my portfolio of projects, from system utilities to web applications." />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://avatars.githubusercontent.com/u/66313685" />
    <meta name="theme-color" content="#0b0d10" />

    <title>Projects — MJDawson</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/reset.css" />
    <link rel="stylesheet" href="/assets/styles.css" />
    <link rel="stylesheet" href="/assets/projects.css" />
    <link rel="icon" href="https://avatars.githubusercontent.com/u/66313685" />

    <script>
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
    <header class="site-header" id="top">
        <div class="container header-inner">
            <a class="brand" href="/" aria-label="Go to home">
                <span class="brand-mark">M</span>
                <span class="brand-text">MJDawson</span>
            </a>

            <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <nav class="nav" aria-label="Primary">
                <ul>
                    <li><a href="/#about">About</a></li>
                    <li><a href="/#skills">Skills</a></li>
                    <li><a href="/projects" aria-current="page">Projects</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="/#contact">Contact</a></li>
                    <li><a href="/chat">Chat</a></li>
                </ul>
            </nav>

            <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false">
                <span class="theme-icon" aria-hidden="true">🌙</span>
            </button>
        </div>
    </header>

    <nav class="breadcrumb" aria-label="Breadcrumb" style="border-bottom: 1px solid var(--border); background: color-mix(in oklab, var(--bg) 94%, transparent);">
        <div class="container" style="display: flex; gap: 8px; padding: 10px 0; color: var(--muted);">
            <a href="/" style="color: var(--muted); text-decoration: none;">Home</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page">Projects</span>
        </div>
    </nav>

    <section class="hero">
        <div class="container hero-inner">
            <div class="hero-copy">
                <h1>All <span class="accent">Projects</span></h1>
                <p class="lead">A complete list of my open source work, experiments, and deployed applications. Check out my code on <a href="https://github.com/MJDaws0n" target="_blank" class="inline-link">GitHub</a>.</p>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="project-list">

                <!-- Kernova -->
                <article class="project-row">
                    <div class="project-content">
                        <div class="project-header">
                            <h2 class="project-title">Kernova</h2>
                            <span class="project-date">2024 - Present</span>
                        </div>
                        <div class="project-short">Stealthy Windows Sandbox & Instrumentation Engine</div>
                        <p class="project-desc">Kernova is a high-fidelity sandbox designed for malware analysis and security research. It mirrors a realistic host environment to prevent evasion while providing deep observability into file system, registry, and network activities. Built with C and Assembly for performance and stealth. It's intended to be used for my A-Level computer science final project.</p>
                        <div class="cta-row">
                            <a class="btn primary" href="/projects/kernova">View Details</a>
                            <a class="btn ghost" href="https://github.com/MJDaws0n/Kernova" target="_blank">GitHub</a>
                        </div>
                    </div>
                    <div class="project-media">
                        <div class="project-slider" data-slider>
                            <div class="slider-track">
                                <div class="slide"><img src="/assets/images/kernova.png" alt="Kernova Architecture" onerror="this.src='https://placehold.co/600x400/12181d/4cc2ff?text=No+Image'"></div>
                            </div>
                            <div class="slider-nav">
                                <button class="slider-btn prev" aria-label="Previous slide">←</button>
                                <button class="slider-btn next" aria-label="Next slide">→</button>
                            </div>
                            <div class="slider-dots"></div>
                        </div>
                    </div>
                </article>

                <!-- ProxyDNSCache -->
                <article class="project-row">
                    <div class="project-content">
                        <div class="project-header">
                            <h2 class="project-title">ProxyDNSCache</h2>
                            <span class="project-date">2024 - Present</span>
                        </div>
                        <div class="project-short">Lightweight TCP/HTTP Traffic Redirector</div>
                        <p class="project-desc">A specialised reverse proxy server that handles all TCP traffic redirection. It takes data from the domain's SVR record and redirects traffic to the server based on that. The correct domain certificate is intelligently selected to ensure a secure connection is in place. HTTP connections are additionally transferred to 443 connections to allow for secure connections. Not only does HTTPS work, but all TLS TCP connections work, including websockets. This means you can essentially have unlimited applications running on a single 443 port.</p>
                        <div class="cta-row">
                            <a class="btn primary" href="https://github.com/MJDaws0n/ProxyDNSCache" target="_blank">View on GitHub</a>
                        </div>
                    </div>
                    <div class="project-media">
                        <div class="project-slider" data-slider>
                            <div class="slider-track">
                                <div class="slide"><img src="/assets/images/proxydnscache.png" alt="Proxy Diagram" onerror="this.src='https://placehold.co/600x400/12181d/4cc2ff?text=Proxy+Diagram'"></div>
                            </div>
                            <div class="slider-nav">
                                <button class="slider-btn prev" aria-label="Previous slide">←</button>
                                <button class="slider-btn next" aria-label="Next slide">→</button>
                            </div>
                            <div class="slider-dots"></div>
                        </div>
                    </div>
                </article>

                <!-- Rich Text Editor -->
                <article class="project-row">
                    <div class="project-content">
                        <div class="project-header">
                            <h2 class="project-title">Rich Text Editor</h2>
                            <span class="project-date">2025</span>
                        </div>
                        <div class="project-short">JSON-Model Based Text Editor</div>
                        <p class="project-desc">A custom-built rich text editor that avoids `contenteditable` pitfalls by using a strict JSON data model. It supports complex formatting, nested structures, and ensures deterministic output. Designed for applications requiring structured content storage.</p>
                        <div class="cta-row">
                            <a class="btn primary" href="https://github.com/MJDaws0n/Rich-Text-Editor" target="_blank">View on GitHub</a>
                            <a class="btn ghost" href="https://mjdaws0n.github.io/Rich-Text-Editor/example.html" target="_blank">Preview</a>
                        </div>
                    </div>
                    <div class="project-media">
                        <div class="project-slider" data-slider>
                            <div class="slider-track">
                                <div class="slide"><img src="/assets/images/rich.png" alt="Editor Interface" onerror="this.src='https://placehold.co/600x400/12181d/4cc2ff?text=Editor+Interface'"></div>
                                <div class="slide"><img src="/assets/images/rich2.png" alt="JSON Structure" onerror="this.src='https://placehold.co/600x400/12181d/4cc2ff?text=JSON+Structure'"></div>
                            </div>
                            <div class="slider-nav">
                                <button class="slider-btn prev" aria-label="Previous slide">←</button>
                                <button class="slider-btn next" aria-label="Next slide">→</button>
                            </div>
                            <div class="slider-dots"></div>
                        </div>
                    </div>
                </article>

                <!-- Tetris -->
                <article class="project-row">
                    <div class="project-content">
                        <div class="project-header">
                            <h2 class="project-title">Tetris</h2>
                            <span class="project-date">2025</span>
                        </div>
                        <div class="project-short">Online Tetris with Live Scoreboard</div>
                        <p class="project-desc">A faithful recreation of the classic Tetris game featuring a live global scoreboard and real-time updates. The architecture utilizes a Dockerized environment with PHP and MySQL for data persistence, and Node.js WebSockets for instant leaderboard synchronization. It captures all the mechanics of the original game while adding modern connectivity.</p>
                        <div class="cta-row">
                            <a class="btn primary" href="https://tetris.mjdawson.net" target="_blank">Play Now</a>
                            <a class="btn ghost" href="https://github.com/MJDaws0n/Tetris" target="_blank">GitHub</a>
                        </div>
                    </div>
                    <div class="project-media">
                        <div class="project-slider" data-slider>
                            <div class="slider-track">
                                <div class="slide"><img src="/assets/images/tetris.png" alt="Tetris Gameplay" onerror="this.src='https://placehold.co/600x400/12181d/4cc2ff?text=Tetris+Gameplay'"></div>
                                <div class="slide"><img src="/assets/images/tetris1.png" alt="Tetris Code" onerror="this.src='https://placehold.co/600x400/12181d/4cc2ff?text=Tetris+Gameplay'"></div>
                            </div>
                            <div class="slider-nav">
                                <button class="slider-btn prev" aria-label="Previous slide">←</button>
                                <button class="slider-btn next" aria-label="Next slide">→</button>
                            </div>
                            <div class="slider-dots"></div>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container footer-inner">
            <small>© <?php echo date('Y'); ?> MJDawson. All rights reserved.</small>
            <nav aria-label="Footer">
                <a href="/">Home</a>
                <a href="/#contact">Contact</a>
                <a href="https://github.com/MJDaws0n" target="_blank">GitHub</a>
            </nav>
        </div>
    </footer>

    <script src="/assets/main.js" defer></script>
</body>
</html>
