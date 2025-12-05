<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        ?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="color-scheme" content="dark light" />
    <meta name="description" content="Portfolio of Max (MJDawson) — UK-based developer. Projects, services, and contact." />
    <meta property="og:title" content="MJDawson — Developer Portfolio" />
    <meta property="og:description" content="Web developer. Explore projects, skills, and services." />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://avatars.githubusercontent.com/u/66313685" />
    <meta name="theme-color" content="#0b0d10" />

    <title>MJDawson — Developer Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/reset.css" />
    <link rel="stylesheet" href="/assets/styles.css" />
    <link rel="icon" href="https://avatars.githubusercontent.com/u/66313685" />

    <script>
      // Early theme boot to avoid FOUC
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
    <!-- Header / Nav -->
    <header class="site-header" id="home">
        <div class="container header-inner">
            <a class="brand" href="#home" aria-label="Go to top">
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
                    <li><a href="#about">About</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="/chat">Chat</a></li>
                </ul>
            </nav>

            <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false">
                <span class="theme-icon" aria-hidden="true">🌙</span>
            </button>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="container hero-inner">
            <div class="hero-copy">
                <h1>Hi, I'm Max — <span class="accent">MJDawson</span></h1>
                <p class="lead">Building fast, user-friendly tools and apps. Turning complex problems into simple, scalable solutions.</p>
                <div class="cta-row">
                    <a class="btn primary" href="#projects">See Projects</a>
                    <a class="btn ghost" href="#contact">Contact Me</a>
                </div>
                <div class="meta-row">
                    <a class="social" href="https://github.com/MJDaws0n" target="_blank" rel="noopener" aria-label="GitHub">
                        <img src="/assets/images/github.png" alt="GitHub" class="github-icon" />
                    </a>
                </div>
            </div>
            <div class="hero-media">
                <img class="avatar" src="https://avatars.githubusercontent.com/u/66313685" alt="Portrait of Max (MJDawson)" />
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="section">
        <div class="container two-col">
            <div>
                <h2>About Me</h2>
                <p>I'm Max, known online as <strong>MJDawson</strong>. I'm a currently in y12. I enjoy building reliable, performance-focused software with clean UX.</p>
                <p>Outside of coding, I spend time swimming training competing at swimming events.</p>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section id="skills" class="section alt">
        <div class="container">
            <h2>Skills & Tools</h2>
            <p class="section-lead">What I work with day-to-day.</p>
            <div class="skills-grid">
                <div class="skill"><img src="/assets/images/html.png" alt="HTML" /><span>HTML</span></div>
                <div class="skill"><img src="/assets/images/css.png" alt="CSS" /><span>CSS</span></div>
                <div class="skill"><img src="/assets/images/js.png" alt="JavaScript" /><span>JavaScript</span></div>
                <div class="skill"><img src="/assets/images/php.png" alt="PHP" class="invert-on-dark" /><span>PHP</span></div>
                <div class="skill"><img src="/assets/images/node.svg" alt="Node.js" class="invert-on-dark" /><span>Node.js</span></div>
                <div class="skill"><img src="/assets/images/mysql.png" alt="MySQL" class="invert-on-dark" /><span>MySQL</span></div>
                <div class="skill"><img src="/assets/images/linux.png" alt="Linux" style="  filter: drop-shadow(2px 0 0 white)drop-shadow(-2px 0 0 white)drop-shadow(0 2px 0 white)drop-shadow(0 -2px 0 white);" /><span>Linux</span></div>
                <div class="skill"><img src="/assets/images/portfolify.png" alt="Portfolify" /><span>Portfolify</span></div>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section id="projects" class="section">
        <div class="container">
            <h2>Featured Projects</h2>
            <div class="cards">
                <article class="card">
                    <h3>ProxyDNSCache</h3>
                    <p>ProxyDNSCache is a lightweight TCP proxy designed to handle redirection of HTTP (port 80) and HTTPS (port 443) traffic. It forwards HTTP traffic to HTTPS and routes HTTPS traffic to the appropriate domain. For example, it can forward traffic from <code>https://example.com/</code> to <code>localhost:304</code>.</p>
                    <div class="card-actions">
                        <a class="btn small" href="https://github.com/MJDaws0n/ProxyDNSCache" target="_blank" rel="noopener">GitHub</a>
                    </div>
                </article>
                <article class="card">
                    <h3>Kernova</h3>
                    <p>Kernova is a high-fidelity sandbox designed for malware analysis and security research. It mirrors a realistic host environment to prevent evasion while providing deep observability into file system, registry, and network activities. Built with C and Assembly for performance and stealth. It's intended to be used for my A-Level computer science final project.</p>
                    <div class="card-actions">
                        <a class="btn small" href="/projects/kernova">View more</a>
                    </div>
                </article>
                <article class="card">
                    <h3>Rich Text Editor</h3>
                    <p>A robust, extensible rich text editor built on a JSON model rather than the DOM. It allows for precise formatting actions (such as bold, italic, and custom options) and ensures consistent behavior even with complex selections. Designed for reliability and flexibility in modern web applications.</p>
                    <div class="card-actions">
                        <a class="btn small" href="https://github.com/MJDaws0n/Rich-Text-Editor" target="_blank" rel="noopener">GitHub</a>
                    </div>
                </article>
            </div>
            <a class="btn primary" href="/projects" style="display:block;margin:32px auto 0 auto;text-align:center;max-width:220px;">View More Projects</a>
        </div>
    </section>

    <!-- Services / Freelance -->
    <section id="services" class="section alt">
        <div class="container">
            <h2>Services</h2>
            <p class="section-lead">Available for select freelance and collaborative work.</p>
            <div class="cards three">
                <article class="card">
                    <h3>Full-Stack Web</h3>
                    <p>Design to deploy: performant, accessible, and maintainable web apps.</p>
                </article>
                <article class="card">
                    <h3>Backend & APIs</h3>
                    <p>Robust services, database design, and integrations with security in mind.</p>
                </article>
                <article class="card">
                    <h3>Dev Tooling</h3>
                    <p>DX improvements, automation, and internal tools to speed up teams.</p>
                </article>
            </div>
            <div class="cta-band">
                <div class="cta-band-content">
                    <h3>Have a project in mind?</h3>
                    <a class="btn primary large start-project" href="#contact">Start a project</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="section">
        <div class="container two-col">
            <div>
                <h2>Get in touch</h2>
                <p>Tell me about your project, role, or idea. I typically reply within 1-2 days.</p>
                <ul class="contact-list">
                    <li>GitHub: <a class="inline-link" href="https://github.com/MJDaws0n" target="_blank" rel="noopener">@MJDaws0n</a></li>
                    <li>Email: <a class="inline-link" href="mailto:contact@mjdawson.net">contact@mjdawson.net</a></li>
                </ul>
            </div>
            <form id="contact-form" class="contact-form" method="post">
                <label>
                    <span>Name</span>
                    <input type="text" name="name" placeholder="Your name" required />
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" placeholder="you@example.com" required />
                </label>
                <label>
                    <span>Message</span>
                    <textarea name="message" rows="5" placeholder="What can I help with?" required></textarea>
                </label>
                <script src="https://autogate.mjdawson.net/lib/autogate.js"></script>
                <div id="captcha"></div>
                <button id="contact-submit" type="submit" class="btn primary full">Send</button>
                <div id="contact-status" class="form-note" role="status" aria-live="polite"></div>
                <p class="form-note">Or email <a class="inline-link" href="mailto:contact@mjdawson.net">contact@mjdawson.net</a> directly.</p>
            </form>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container footer-inner">
            <small>© <?php echo date('Y'); ?> MJDawson. All rights reserved.</small>
            <nav aria-label="Footer">
                <a href="#home">Top</a>
                <a href="#projects">Projects</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
    </footer>

    <script src="/assets/main.js" defer></script>
</body>
</html>
        <?php
    }

    public function chat()
    {
        $chatUrl = 'https://chat-v1.mjdawson.net';
        if (!headers_sent()) {
            header('Location: ' . $chatUrl, true, 302);
        }
        echo "<p id='text' style=\"font:16px/1.4 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Inter,Helvetica,Arial,sans-serif; padding:24px;\">Redirecting to unique generated chat URL…</p>";
        echo '<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($chatUrl, ENT_QUOTES) . '">';
        echo '<script>window.location.href = "' . addslashes($chatUrl) . '";</script>';
        exit();
    }
}
