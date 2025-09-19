<?php
require_once dirname(__FILE__).'/../../../../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="color-scheme" content="dark light" />
	<meta name="description" content="Kernova — a stealthy, high-fidelity sandbox for Windows applications with deep observability and strong containment." />
	<meta property="og:title" content="Kernova — Stealth Sandbox" />
	<meta property="og:description" content="Run Windows apps in a believable sandbox with forensic-grade visibility. Explore goals, architecture, and roadmap." />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="https://avatars.githubusercontent.com/u/66313685" />
	<meta name="theme-color" content="#0b0d10" />

	<title>Kernova — Project by MJDawson</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="/assets/reset.css" />
	<link rel="stylesheet" href="/assets/styles.css" />
	<link rel="stylesheet" href="/assets/kernova.css" />
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
					<li><a href="/#projects">Projects</a></li>
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

	<nav class="breadcrumb" aria-label="Breadcrumb">
		<div class="container">
			<a href="/">Home</a>
			<span aria-hidden="true">/</span>
			<a href="/#projects">Projects</a>
			<span aria-hidden="true">/</span>
			<span aria-current="page">Kernova</span>
		</div>
	</nav>

	<section class="hero">
		<div class="container hero-inner">
			<div class="hero-copy">
				<h1>Kernova — <span class="accent">Stealth Sandbox</span></h1>
				<p class="lead">Run Windows applications inside a believable, contained environment with forensic-grade observability — file and registry I/O, process lifecycle, network attempts, and memory snapshots — while keeping the host safe. Designed for native-like execution that’s indistinguishable from the host with near‑lossless performance.</p>
				<div class="cta-row">
					<a class="btn primary" href="https://github.com/MJDaws0n/Kernova" target="_blank" rel="noopener">View on GitHub</a>
					<a class="btn ghost" href="/">Back to Home</a>
				</div>
			</div>
		</div>
	</section>

	<section class="section" id="contents">
		<div class="container doc-intro">
			<aside class="toc" aria-label="Table of contents">
				<strong>On this page</strong>
				<ul>
					<li><a href="#overview">Overview</a></li>
					<li><a href="#capabilities">What It Does</a></li>
					<li><a href="#benefits">Benefits</a></li>
					<li><a href="#architecture">Architecture</a></li>
					<li><a href="#implementation">Implementation</a></li>
					<li><a href="#data-flows">Data Flows</a></li>
					<li><a href="#strategy">Strategy</a></li>
					<li><a href="#roadmap">Roadmap</a></li>
					<li><a href="#mvp">MVP & Demo</a></li>
				</ul>
			</aside>
			<div class="summary highlight">
				<h2>Quick Summary</h2>
				<p>Kernova provides the sweet spot between authenticity and control: a sandbox that preserves a program’s normal view of a Windows host while giving the analyst full visibility, containment, and replayability.</p>
			</div>
		</div>
	</section>

	<section class="section alt" id="implementation">
		<div class="container">
			<div>
				<h2>Implementation & Languages</h2>
				<p class="section-lead">Kernova will be implemented primarily in <strong>C</strong> for predictable performance, small binaries and direct control over OS interfaces. Select components will use <strong>assembly</strong> where low-level hooks, syscall stubs or highly tuned hot paths are warranted.</p>
                <p class="section-lead"><strong>Core runtime (C):</strong> launcher/controller, environment mirror, event bus, and artifact management built in C for portability and tight control.</p>
                <p class="section-lead"><strong>Instrumentation (C):</strong> file/registry/process/network instrumentation using well-defined OS APIs, minimizing footprint and preserving timing.</p>
                <p class="section-lead"><strong>Targeted assembly:</strong> minimal, localized routines for syscall shims, context capture, and fast-path probes where C isn’t granular enough.</p>
                <p class="section-lead"><strong>Interop boundaries:</strong> clean interfaces between C modules and any assembly stubs to maintain readability and testability.</p>
			</div>
			<div>
				<h2>Build & Portability</h2>
				<p class="section-lead">Prefer a straightforward build toolchain with clear targets for the launcher, instrumentation libraries, and optional helpers. Keep code isolated behind feature flags and clear abstraction layers.</p>
				<div class="highlight">
					<ul class="bullets">
						<li><strong>Static analysis:</strong> enable warnings-as-errors and sanitizers in dev builds.</li>
						<li><strong>Artifacts:</strong> deterministic builds where possible; symbol maps for debug builds only.</li>
						<li><strong>Testing:</strong> unit tests for event schema and redirection logic; replay-based integration checks.</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="section" id="overview">
		<div class="container two-col">
			<div>
				<h2>Overview</h2>
				<p class="section-lead">Kernova is a stealthy, high-fidelity sandbox for Windows apps. It mirrors a realistic host environment so targets behave authentically — often indistinguishable from running on the host — while side effects are routed into an isolated image with deep, structured telemetry and near‑lossless performance.</p>
                <p class="section-lead">Kernova offers realistic environment fidelity to reduce sandbox detection, granular observability across file, registry, process, network, and memory, strong containment so writes never touch the real host, and repeatable runs with replay and diffing across configurations.</p>
			</div>
			<div>
				<h2>The Problem</h2>
				<p class="section-lead">Lightweight sandboxes can change behaviour or get detected; full VMs are heavy and difficult to instrument. Kernova aims for the middle ground: believable fidelity + deep observability + strong containment for safe, insightful analysis.</p>
				<div class="cta-row">
					<a class="btn" href="#roadmap">See Roadmap</a>
					<a class="btn" href="#mvp">MVP Checklist</a>
				</div>
			</div>
		</div>
	</section>

	<section class="section alt" id="capabilities">
		<div class="container">
			<h2>What It Does</h2>
			<div class="cards three">
				<article class="card"><h3>Contained Execution</h3><p>Launch a Windows executable inside a contained runtime that mirrors the host. All writes are redirected into a sandbox image.</p></article>
				<article class="card"><h3>Deep Telemetry</h3><p>Log file/registry I/O, process/thread lifecycle, module loads, and network attempts to a structured, timestamped event store.</p></article>
				<article class="card"><h3>Memory Snapshots</h3><p>Capture memory states at start, periodic intervals, end, or on-demand. Link snapshots into the event timeline for forensics.</p></article>
				<article class="card"><h3>Network Gate</h3><p>Allow, block, or proxy outbound connections. Provide synthetic or recorded responses to coax behaviour without Internet access.</p></article>
				<article class="card"><h3>Replay & Compare</h3><p>Re-run targets under saved environments and diff timelines to highlight behavioural changes across configurations.</p></article>
				<article class="card"><h3>Practical UX</h3><p>Drag-and-drop launching, live timeline, filters, and quick export/reporting to keep analysis fast and repeatable.</p></article>
			</div>
		</div>
	</section>

	<section class="section" id="benefits">
		<div class="container">
			<h2>Key Benefits</h2>
			<div class="cards three">
				<article class="card"><h3>Authenticity</h3><p>Targets see a believable host — execution feels native and near‑lossless, increasing the chance of normal behaviour.</p></article>
				<article class="card"><h3>Visibility</h3><p>Detailed event timelines and memory captures enable precise, forensic analysis.</p></article>
				<article class="card"><h3>Safety & Control</h3><p>Side effects are contained; network paths are explicitly governed by rules.</p></article>
			</div>
		</div>
	</section>

	<section class="section alt" id="architecture">
		<div class="container">
			<h2>Architecture (Conceptual)</h2>
			<div class="cards">
				<article class="card"><h3>Launcher / Controller</h3><p>Orchestrates runs: configuration, environment snapshot, launch, monitoring, and shutdown. Stores run metadata and annotations.</p></article>
				<article class="card"><h3>Environment Mirror</h3><p>Presents a localized view of filesystem, registry, and visible services. Redirects writes into the sandbox image.</p></article>
				<article class="card"><h3>Observation & Event Bus</h3><p>Collects file, process, module, and network events as structured records with timestamps and context.</p></article>
				<article class="card"><h3>Memory Snapshotter</h3><p>Captures process memory at configured points; snapshots are catalogued and linked to the timeline.</p></article>
				<article class="card"><h3>Network Gate / Proxy</h3><p>Controls outbound connections: allow, block, or proxy. Supports canned responses to simulate services.</p></article>
				<article class="card"><h3>Replay & Comparison</h3><p>Replays event sequences or re-runs under saved environments to compute diffs between runs.</p></article>
				<article class="card"><h3>User Interface</h3><p>Live timeline with filters, snapshot browser, and export/report tools. CLI for automation.</p></article>
			</div>
		</div>
	</section>

	<section class="section" id="data-flows">
		<div class="container two-col">
			<div>
				<h2>Data Flows</h2>
				<ol class="timeline" aria-label="Data flow timeline">
					<li>
						<h4>Configure & Launch</h4>
						<p>User configuration is applied; the Launcher creates an isolated environment snapshot and starts the run.</p>
					</li>
					<li>
						<h4>Instrument & Collect</h4>
						<p>Hooks emit structured events which the Event Bus timestamps and aggregates.</p>
					</li>
					<li>
						<h4>Contain Side Effects</h4>
						<p>File and registry writes are redirected into the sandbox image; logs record virtual paths and outcomes.</p>
					</li>
					<li>
						<h4>Gate Networking</h4>
						<p>Network calls traverse the Network Gate where allow/block/proxy rules are applied and logged.</p>
					</li>
					<li>
						<h4>Snapshot Memory</h4>
						<p>Memory snapshots are captured at configured points and stored as artifacts linked into the timeline.</p>
					</li>
					<li>
						<h4>Review & Replay</h4>
						<p>After shutdown, artifacts and timeline are available for review, export, or replay for comparison.</p>
					</li>
				</ol>
			</div>
			<div>
				<h2>Event Types</h2>
				<div class="event-grid" role="list" aria-label="Event types">
					<div class="event-card" role="listitem">
						<div class="etype">File</div>
						<div class="examples">open, read, write, delete, rename</div>
					</div>
					<div class="event-card" role="listitem">
						<div class="etype">Registry</div>
						<div class="examples">key read, write, create, delete</div>
					</div>
					<div class="event-card" role="listitem">
						<div class="etype">Process</div>
						<div class="examples">spawn, exit, loaded modules</div>
					</div>
					<div class="event-card" role="listitem">
						<div class="etype">Network</div>
						<div class="examples">connections, DNS requests, HTTP endpoints</div>
					</div>
					<div class="event-card" role="listitem">
						<div class="etype">Memory</div>
						<div class="examples">snapshot markers, regions of interest</div>
					</div>
					<div class="event-card" role="listitem">
						<div class="etype">Anomalies</div>
						<div class="examples">crashes, violations, suspicious patterns</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section alt" id="strategy">
		<div class="container">
			<h2>Abstraction & Fidelity Strategy</h2>
			<p>Keep the surface area close to a real Windows host at the chosen fidelity level (filesystem layout, common registry keys, expected services). Route side-effecting operations into ephemeral or versioned images so each run starts clean.</p>
			<p>Prefer proxies and canned responses to simulate services. Instrumentation should be structured and minimally invasive to preserve observable timing and behaviour.</p>
		</div>
	</section>

	<section class="section" id="roadmap">
		<div class="container">
			<h2>Build Plan & Phases</h2>
			<div class="cards">
				<article class="card"><h3>Phase 0 — Design & Prototypes</h3><p>Define run configuration and event schema. Mock UI flows and prototype sandbox image format and metadata store.</p></article>
				<article class="card"><h3>Phase 1 — MVP</h3><p>Overlay filesystem containment; basic file and process logging; simple GUI timeline.</p></article>
				<article class="card"><h3>Phase 2 — Networking & Snapshots</h3><p>Network rules and logging; memory snapshots linked to the timeline; richer logging schema.</p></article>
				<article class="card"><h3>Phase 3 — Replay & Comparison</h3><p>Automatic replay under saved environments and timeline diffing; side-by-side comparisons.</p></article>
				<article class="card"><h3>Phase 4 — UX & Hardening</h3><p>Filters, search, export templates, report generator; containment hardening and optional canned services.</p></article>
			</div>
		</div>
	</section>

	<section class="section alt" id="mvp">
		<div class="container two-col">
			<div>
				<h2>MVP Checklist</h2>
				<div class="highlight">
					<ul class="bullets">
						<li>Launch config + run metadata</li>
						<li>Sandboxed filesystem overlay</li>
						<li>File and process event logging</li>
						<li>GUI timeline and event viewer</li>
						<li>Exportable run logs and artifacts</li>
						<li>Simple network rules (allow/block/proxy)</li>
					</ul>
				</div>
			</div>
			<div>
				<h2>Demo Plan</h2>
				<div class="highlight">
					<ul class="bullets">
						<li>Show UI and prepared run config</li>
						<li>Drag benign binary and start run</li>
						<li>Live timeline: file write, process spawn, network attempt</li>
						<li>Open a memory snapshot linked in time</li>
						<li>Re-run with network blocked and show diff</li>
						<li>Export a run report</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="section" id="cta">
		<div class="container">
			<div class="cta-band">
				<div class="cta-band-content">
					<h3>Follow progress on GitHub</h3>
					<a class="btn large primary" href="https://github.com/MJDaws0n/Kernova" target="_blank" rel="noopener">Open Repository</a>
				</div>
			</div>
		</div>
	</section>

	<footer class="site-footer">
		<div class="container footer-inner">
			<small>© <?php echo date('Y'); ?> MJDawson. All rights reserved.</small>
			<nav aria-label="Footer">
				<a href="#top">Top</a>
				<a href="/#projects">Projects</a>
				<a href="/#contact">Contact</a>
			</nav>
		</div>
	</footer>

	<script src="/assets/main.js" defer></script>
</body>
</html>
