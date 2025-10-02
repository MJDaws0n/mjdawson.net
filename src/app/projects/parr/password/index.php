<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Password Strength Checker - mjdawson.net</title>
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="/assets/parr/password/styles.css" />
	</head>
	<body class="theme theme--light">
		<div class="app-shell">
			<header class="app-header">
				<div class="brand">
					<span class="brand__glow" aria-hidden="true"></span>
					<span class="brand__name">Password Checker</span>
				</div>
				<button
					class="theme-toggle"
					type="button"
					aria-pressed="false"
					aria-label="Toggle dark mode"
				>
					<span class="theme-toggle__icon theme-toggle__icon--sun" aria-hidden="true"></span>
					<span class="theme-toggle__icon theme-toggle__icon--moon" aria-hidden="true"></span>
				</button>
			</header>

			<main class="card" role="main">
				<section class="card__header">
					<h1 class="card__title">Check your password strength</h1>
					<p class="card__subtitle">
						Paste a password or let the generator craft one. Highlight
						weaknesses, and suggest improvements in real time.
					</p>
				</section>

				<section class="controller" aria-labelledby="password-label">
					<div class="controller__input-group">
						<label id="password-label" class="controller__label" for="password-input">
							Password
						</label>
						<div class="controller__field">
							<input
								id="password-input"
								class="controller__input"
								type="password"
								placeholder="P@ssw0rd!"
								autocomplete="off"
								spellcheck="false"
								aria-describedby="password-hint password-strength-label"
							/>
							<button class="controller__reveal" type="button" aria-label="Reveal password">
								<span class="controller__reveal-icon" aria-hidden="true"></span>
							</button>
						</div>
						<p id="password-hint" class="controller__hint">
							Everything happens offline on your device, no data is transfered.
						</p>
					</div>
				</section>

				<section class="strength" aria-live="polite">
					<div class="strength__meter" role="presentation">
						<div class="strength__segments" data-strength-meter>
							<span class="strength__segment"></span>
							<span class="strength__segment"></span>
							<span class="strength__segment"></span>
							<span class="strength__segment"></span>
							<span class="strength__segment"></span>
						</div>
					</div>
					<div class="strength__summary">
						<p id="password-strength-label" class="strength__label" data-strength-label>
							Start typing to see your score.
						</p>
						<span class="strength__score" data-strength-score aria-hidden="true"></span>
					</div>
				</section>

				<section class="insights" aria-labelledby="insights-title">
					<div class="insights__header">
						<h2 id="insights-title" class="insights__title">Strength criteria</h2>
						<button class="insights__suggest" type="button" data-generate-password>
							Generate robust password
						</button>
					</div>
					<ul class="insights__list" data-criteria-list>
						<li class="insights__item" data-criteria="length">
							<span class="insights__status" aria-hidden="true"></span>
							<strong>At least 12 characters</strong>
						</li>
						<li class="insights__item" data-criteria="upper-lower">
							<span class="insights__status" aria-hidden="true"></span>
							<strong>Mix of uppercase &amp; lowercase</strong>
						</li>
						<li class="insights__item" data-criteria="numeric">
							<span class="insights__status" aria-hidden="true"></span>
							<strong>Include at least one number</strong>
						</li>
						<li class="insights__item" data-criteria="symbol">
							<span class="insights__status" aria-hidden="true"></span>
							<strong>Include at least one symbol</strong>
						</li>
						<li class="insights__item" data-criteria="entropy">
							<span class="insights__status" aria-hidden="true"></span>
							<strong>Avoid repetition &amp; common patterns</strong>
						</li>
					</ul>
				</section>
			</main>

			<footer class="app-footer">
				<p class="app-footer__text">
					Tip: longer passphrases with random words and symbols stay memorable yet strong.
				</p>
			</footer>
		</div>

		<script src="/assets/parr/password/main.js" defer></script>
	</body>
</html>
