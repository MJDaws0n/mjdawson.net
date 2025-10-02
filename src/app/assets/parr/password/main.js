/**
 * Represents a password strength checker with UI bindings and analytics.
 * Skibidi toilet
 * Sigma 123
 * Like my code?
 */
class PasswordStrengthChecker {
	/**
	 * @param {Object} options - Custom configuration for the checker.
	 * @param {HTMLElement} [options.root=document.body] - The root element hosting theme classes.
	 */
	constructor(options = {}) {
		const root = options.root ?? document.body;

		this.root = root;
		this.elements = {
			input: document.getElementById('password-input'),
			revealButton: document.querySelector('.controller__reveal'),
			strengthMeter: document.querySelector('[data-strength-meter]'),
			strengthLabel: document.querySelector('[data-strength-label]'),
			strengthScore: document.querySelector('[data-strength-score]'),
			criteriaList: document.querySelector('[data-criteria-list]'),
			themeToggle: document.querySelector('.theme-toggle'),
			generateButton: document.querySelector('[data-generate-password]'),
		};

		/**
		 * Internal state snapshot.
		 * @type {{ theme: 'light' | 'dark', isPasswordVisible: boolean }}
		 */
		this.state = {
			theme: 'light',
			isPasswordVisible: false,
		};

		this.localStorageKey = 'pulseguard.theme';
	}

	/**
	 * Binds UI events, restores preferences, and performs initial evaluation.
	 * @returns {void}
	 */
	init() {
		if (!this.#hasRequiredElements()) {
			console.warn('PulseGuard: Missing required markup. Aborting initialization.');
			return;
		}

		this.#hydrateTheme();
		this.#bindEvents();
		this.evaluate('');
	}

	/**
	 * Attaches DOM listeners for interactions.
	 * @returns {void}
	 */
	#bindEvents() {
		this.elements.input.addEventListener('input', (event) => {
			this.evaluate(String(event.target.value));
		});

		this.elements.revealButton.addEventListener('click', () => {
			this.togglePasswordVisibility();
		});

		this.elements.themeToggle.addEventListener('click', () => {
			this.toggleTheme();
		});

		this.elements.generateButton.addEventListener('click', () => {
			const generated = this.generatePassword();
			this.elements.input.value = generated;
			this.evaluate(generated);
			this.elements.input.focus();
			this.#flashField();
		});
	}

	/**
	 * Verifies that all critical DOM nodes are present.
	 * @returns {boolean} Whether the DOM structure is ready.
	 */
	#hasRequiredElements() {
		return Object.values(this.elements).every((value) => value instanceof HTMLElement);
	}

	/**
	 * Performs password evaluation and updates the UI accordingly.
	 * @param {string} password - The candidate password to assess.
	 * @returns {void}
	 */
	evaluate(password) {
		const report = this.#generateReport(password);
		this.#renderReport(report);
	}

	/**
	 * Computes strength data for a password.
	 * @param {string} password - User supplied password.
	 * @returns {{
	 *   password: string,
	 *   score: number,
	 *   label: string,
	 *   tone: 'info' | 'warning' | 'danger' | 'success',
	 *   criteria: Record<string, { met: boolean, critical?: boolean }>;
	 * }}
	 */
	#generateReport(password) {
		const trimmed = password.trim();
		const lengthMet = trimmed.length >= 12;
		const lowerMet = /[a-z]/.test(trimmed);
		const upperMet = /[A-Z]/.test(trimmed);
		const numericMet = /\d/.test(trimmed);
		const symbolMet = /[^a-zA-Z\d\s]/.test(trimmed);

		const sequences = /(0123|1234|2345|3456|4567|5678|6789|abcd|bcde|cdef|pass|word|admin|qwerty|letmein)/i;
		const repetition = /(.)\1{2,}/;
		const entropyMet = trimmed.length >= 8 && !sequences.test(trimmed) && !repetition.test(trimmed);

		const criteria = {
			length: { met: lengthMet, critical: true },
			'upper-lower': { met: lowerMet && upperMet, critical: true },
			numeric: { met: numericMet, critical: false },
			symbol: { met: symbolMet, critical: false },
			entropy: { met: entropyMet, critical: true },
		};

		const baseScore = Object.values(criteria).reduce((total, rule) => total + Number(rule.met), 0);
		const bonus = trimmed.length >= 18 ? 1 : 0;
		const score = Math.min(5, Math.max(0, baseScore + bonus));

		let label = 'Start typing to see your score.';
		let tone = 'info';

		if (trimmed.length) {
			switch (score) {
				case 0:
				case 1:
					label = 'Very weak — attackers can guess this instantly.';
					tone = 'danger';
					break;
				case 2:
					label = 'Weak — add more length and variety to stay safe.';
					tone = 'warning';
					break;
				case 3:
					label = 'Fair — better than average, but there\'s room to harden it.';
					tone = 'warning';
					break;
				case 4:
					label = 'Strong — resilient against common attacks.';
					tone = 'success';
					break;
				case 5:
					label = 'Elite — highly resistant to brute force.';
					tone = 'success';
					break;
				default:
					break;
			}
		}

		return {
			password: trimmed,
			score,
			label,
			tone,
			criteria,
		};
	}

	/**
	 * Renders strength report into the DOM.
	 * @param {{score: number, label: string, tone: string, criteria: Record<string, {met: boolean, critical?: boolean}>}} report - Strength metadata.
	 * @returns {void}
	 */
	#renderReport(report) {
		this.#updateStrengthMeter(report.score);
		this.#updateStrengthSummary(report);
		this.#updateCriteriaList(report);
	}

	/**
	 * Updates segmented strength meter to reflect the score.
	 * @param {number} score - Normalized score out of five.
	 * @returns {void}
	 */
	#updateStrengthMeter(score) {
		const segments = Array.from(this.elements.strengthMeter.children);
		segments.forEach((segment, index) => {
			segment.dataset.active = index < score ? 'true' : 'false';
		});
	}

	/**
	 * Updates the textual summary of strength results.
	 * @param {{ score: number, label: string, tone: string }} report - Scorecard to render.
	 * @returns {void}
	 */
	#updateStrengthSummary(report) {
		this.elements.strengthLabel.textContent = report.label;

		if (report.score === 0) {
			this.elements.strengthScore.textContent = '';
			return;
		}

		this.elements.strengthScore.textContent = `${report.score}/5`;
		this.elements.strengthScore.dataset.tone = report.tone;
	}

	/**
	 * Annotates the criteria list based on rule compliance.
	 * @param {{ criteria: Record<string, { met: boolean, critical?: boolean }>, score: number }} report - Rule evaluation detail.
	 * @returns {void}
	 */
	#updateCriteriaList(report) {
		const items = this.elements.criteriaList.querySelectorAll('.insights__item');
		items.forEach((item) => {
			const ruleKey = item.dataset.criteria;
			const rule = report.criteria[ruleKey];

			if (!rule) {
				item.dataset.state = 'pending';
				return;
			}

			if (rule.met) {
				item.dataset.state = 'met';
			} else {
				item.dataset.state = report.score >= 3 && !rule.critical ? 'pending' : 'risk';
			}
		});
	}

	/**
	 * Reveals or hides the password input content.
	 * @returns {void}
	 */
	togglePasswordVisibility() {
		this.state.isPasswordVisible = !this.state.isPasswordVisible;
		const type = this.state.isPasswordVisible ? 'text' : 'password';
		this.elements.input.setAttribute('type', type);
		this.elements.revealButton.dataset.visible = String(this.state.isPasswordVisible);
		this.elements.revealButton.setAttribute(
			'aria-label',
			this.state.isPasswordVisible ? 'Hide password' : 'Reveal password'
		);
	}

	/**
	 * Cycles between light and dark themes.
	 * @returns {void}
	 */
	toggleTheme() {
		const targetTheme = this.state.theme === 'light' ? 'dark' : 'light';
		this.#applyTheme(targetTheme);
		this.#persistTheme(targetTheme);
	}

	/**
	 * Generates a password built to satisfy all criteria.
	 * @param {number} [length=16] - Desired password length.
	 * @returns {string} A randomized password suggestion.
	 */
	generatePassword(length = 16) {
		const minLength = Math.max(length, 16);
		const charset = {
			upper: 'ABCDEFGHJKLMNPQRSTUVWXYZ',
			lower: 'abcdefghijkmnopqrstuvwxyz',
			number: '23456789',
			symbol: '!@#$%&*?+-_=~',
		};

		const generator = [
			this.#pickRandom(charset.upper),
			this.#pickRandom(charset.lower),
			this.#pickRandom(charset.number),
			this.#pickRandom(charset.symbol),
		];

		const pool = Object.values(charset).join('');
		for (let i = generator.length; i < minLength; i += 1) {
			generator.push(this.#pickRandom(pool));
		}

		const shuffled = this.#shuffle(generator).join('');
		return shuffled.slice(0, minLength);
	}

	/**
	 * Restores theme preference from storage.
	 * @returns {void}
	 */
	#hydrateTheme() {
		const savedTheme = window.localStorage?.getItem(this.localStorageKey);
		const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
		const resolved = savedTheme === 'light' || savedTheme === 'dark' ? savedTheme : prefersDark ? 'dark' : 'light';
		this.#applyTheme(resolved);
	}

	/**
	 * Applies the requested theme to the root element.
	 * @param {'light' | 'dark'} theme - Theme identifier.
	 * @returns {void}
	 */
	#applyTheme(theme) {
		this.state.theme = theme;
		this.root.classList.toggle('theme--dark', theme === 'dark');
		this.root.classList.toggle('theme--light', theme === 'light');
		this.elements.themeToggle.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
	}

	/**
	 * Stores theme preference in localStorage.
	 * @param {'light' | 'dark'} theme - Theme identifier to store.
	 * @returns {void}
	 */
	#persistTheme(theme) {
		try {
			window.localStorage?.setItem(this.localStorageKey, theme);
		} catch (error) {
			console.warn('PulseGuard: Unable to persist theme preference.', error);
		}
	}

	/**
	 * Picks a single random character from a charset.
	 * @param {string} charset - Candidate characters.
	 * @returns {string} A single character.
	 */
	#pickRandom(charset) {
		const index = Math.floor(Math.random() * charset.length);
		return charset.charAt(index);
	}

	/**
	 * Returns a shuffled copy of an array.
	 * @template T
	 * @param {T[]} iterable - Array to shuffle.
	 * @returns {T[]} Shuffled copy.
	 */
	#shuffle(iterable) {
		const collection = [...iterable];
		for (let i = collection.length - 1; i > 0; i -= 1) {
			const j = Math.floor(Math.random() * (i + 1));
			[collection[i], collection[j]] = [collection[j], collection[i]];
		}
		return collection;
	}

	/**
	 * Briefly highlights the password field to signal generation.
	 * @returns {void}
	 */
	#flashField() {
		this.elements.input.classList.add('is-highlighted');
		window.setTimeout(() => {
			this.elements.input.classList.remove('is-highlighted');
		}, 420);
	}
}

document.addEventListener('DOMContentLoaded', () => {
	const checker = new PasswordStrengthChecker({ root: document.body });
	checker.init();
});
