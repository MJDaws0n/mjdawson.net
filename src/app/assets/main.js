
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

// Contact form
if (contactForm) {
    let isSubmitting = false;
    let autogateToken = null;

    // Initialize AutoGate
    if (typeof AutoGate !== 'undefined') {
        const gate = new AutoGate('#captcha', '71f6c02ab3795a11f402f692ae3b43b8');
        gate.onSuccess = (token) => {
            console.log('Verified! Token:', token);
            autogateToken = token;
            setStatus('Verification successful. You can now send your message.', 'success');
        };
    }

    function setStatus(msg, type = 'info') {
        if (!contactStatus) return;
        contactStatus.textContent = msg;
        contactStatus.dataset.type = type;
    }

    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (isSubmitting) return;

        if (!autogateToken) {
            setStatus('Please complete the verification check.', 'error');
            return;
        }

        isSubmitting = true;
        if (contactSubmit) {
            contactSubmit.disabled = true;
            contactSubmit.textContent = 'Sending…';
        }
        setStatus('Sending...', 'info');

        const fd = new FormData(contactForm);
        fd.append('token', autogateToken);

        try {
            const resp = await fetch('/contact.php', {
                method: 'POST',
                body: fd,
                headers: { 'Accept': 'application/json' }
            });

            let payload;
            try {
                payload = await resp.json();
            } catch (e) {
                payload = null;
            }

            if (resp.ok && payload && payload.status === 'success') {
                setStatus('Thanks — your message was sent. I\'ll get back to you soon.', 'success');
                contactForm.reset();
                autogateToken = null;
                // Reset AutoGate if possible - assuming re-init or page reload is needed for now as reset method is unknown
                // But if the user wants to send another, they might need to refresh or we re-init.
                // For now, let's just leave it.
            } else {
                setStatus((payload && payload.message) || 'Sorry, something went wrong. Please try again.', 'error');
            }
        } catch (err) {
            setStatus('Network error. Check your connection and try again.', 'error');
        } finally {
            if (contactSubmit) {
                contactSubmit.disabled = false;
                contactSubmit.textContent = 'Send';
            }
            isSubmitting = false;
        }
    });
}

// Project Slider Logic
const sliders = document.querySelectorAll('[data-slider]');

sliders.forEach(slider => {
    const track = slider.querySelector('.slider-track');
    if (!track) return;
    
    const slides = Array.from(track.children);
    const nextBtn = slider.querySelector('.next');
    const prevBtn = slider.querySelector('.prev');
    const dotsContainer = slider.querySelector('.slider-dots');
    
    if (slides.length === 0) return;

    let currentIndex = 0;

    // Create dots
    if (dotsContainer) {
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
    }

    const dots = dotsContainer ? Array.from(dotsContainer.children) : [];

    function updateDots(index) {
        dots.forEach(dot => dot.classList.remove('active'));
        if (dots[index]) dots[index].classList.add('active');
    }

    function goToSlide(index) {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        
        currentIndex = index;
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        updateDots(currentIndex);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
    }
    
    // Hide nav if only 1 slide
    if (slides.length <= 1) {
        if (nextBtn) nextBtn.style.display = 'none';
        if (prevBtn) prevBtn.style.display = 'none';
        if (dotsContainer) dotsContainer.style.display = 'none';
    }
});