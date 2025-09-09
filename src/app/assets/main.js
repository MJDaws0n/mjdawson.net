
const root = document.documentElement;
const themeBtn = document.getElementById('theme-toggle');
const navToggle = document.querySelector('.nav-toggle');
const nav = document.querySelector('.nav');
const contactForm = document.getElementById('contact-form');
const contactSubmit = document.getElementById('contact-submit');
const contactStatus = document.getElementById('contact-status');

function getTheme() {
	return root.getAttribute('data-theme') || 'dark';
}

function setTheme(next) {
	root.setAttribute('data-theme', next);
	try { localStorage.setItem('theme', next); } catch (e) { }
	if (themeBtn) {
		themeBtn.setAttribute('aria-pressed', String(next === 'dark'));
		themeBtn.querySelector('.theme-icon').textContent = next === 'dark' ? '🌙' : '☀️';
	}
}

if (themeBtn) {
	themeBtn.addEventListener('click', () => {
		const next = getTheme() === 'dark' ? 'light' : 'dark';
		setTheme(next);
	});
	// Initialize aria state
	setTheme(getTheme());
}

// Mobile nav toggle
if (navToggle && nav) {
	navToggle.addEventListener('click', () => {
		const open = nav.classList.toggle('open');
		navToggle.setAttribute('aria-expanded', String(open));
	});
	nav.addEventListener('click', (e) => {
		if (e.target.tagName === 'A') {
			nav.classList.remove('open');
			navToggle.setAttribute('aria-expanded', 'false');
		}
	});
}

// Contact form + Autogate integration
// Only render/show Autogate when Send is pressed.
if (contactForm) {
	let isSubmitting = false;

	function setStatus(msg, type = 'info') {
		if (!contactStatus) return;
		contactStatus.textContent = msg;
		contactStatus.dataset.type = type;
	}

	async function sendForm(sessionToken) {
		// Build FormData
		const fd = new FormData(contactForm);
		if (sessionToken) fd.set('autogate', sessionToken);

		try {
			const resp = await fetch('/contact.php', {
				method: 'POST',
				body: fd,
				headers: { 'Accept': 'application/json' }
			});

			// Try JSON first, fallback to text
			let ok = resp.ok;
			let payload;
			try {
				payload = await resp.clone().json(); // clone allows another read
			} catch (_) {
				try {
					payload = await resp.text();
				} catch (e) {
					payload = null;
				}
			}

			if (ok) {
				setStatus('Thanks — your message was sent. I\'ll get back to you soon.', 'success');
				document.querySelector('.ww-autogate-enable-container').remove();
				document.querySelector('#ww-autogate').style.display = '';
				contactForm.reset();
			} else {
				setStatus('Sorry, something went wrong sending your message. Please try again.', 'error');
			}
		} catch (err) {
			setStatus('Network error. Check your connection and try again.' + err, 'error');
		} finally {
			if (contactSubmit) {
				contactSubmit.disabled = false;
				contactSubmit.textContent = 'Send';
			}
			// Allow future submissions after this attempt finishes
			isSubmitting = false;
		}
	}

	contactForm.addEventListener('submit', (e) => {
		e.preventDefault();
		if (isSubmitting) return;
		isSubmitting = true;
		// Disable button to prevent double submits
		if (contactSubmit) {
			contactSubmit.disabled = true;
			contactSubmit.textContent = 'Verifying…';
		}
		setStatus('Starting human verification…', 'info');

		try {
			// Instantiate Autogate now so it only shows when the user submits.
			const autogate = new WebWorksAutoGate('#ww-autogate', '/contact.php');
			// Define nicer callbacks immediately
			autogate.robot = () => {
				// Soft notice; Autogate will retry automatically
				setStatus('Verifying you\'re human…', 'info');
			};
			autogate.human = (session) => {
				// Verified: send the form
				setStatus('Verified — sending your message…', 'info');
				if (contactSubmit) contactSubmit.textContent = 'Sending…';
				sendForm(session);
			};
		} catch (err) {
			setStatus('Unable to start verification. Please refresh and try again.', 'error');
			if (contactSubmit) {
				contactSubmit.disabled = false;
				contactSubmit.textContent = 'Send';
			}
			isSubmitting = false;
		}
	});
}