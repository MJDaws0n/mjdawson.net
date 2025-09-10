/* HowSt Cafe front-end interactions */
(() => {
	const qs = (s, el=document) => el.querySelector(s);
	const qsa = (s, el=document) => [...el.querySelectorAll(s)];

	// Mobile navigation toggle
	const navToggle = qs('#navToggle');
	const navList = qs('#nav-menu');
	if (navToggle && navList) {
		navToggle.addEventListener('click', () => {
			const expanded = navToggle.getAttribute('aria-expanded') === 'true';
			navToggle.setAttribute('aria-expanded', String(!expanded));
			navList.classList.toggle('active');
			document.body.classList.toggle('nav-open', !expanded);
		});
		// Close on escape
		document.addEventListener('keydown', e => {
			if (e.key === 'Escape' && navList.classList.contains('active')) {
				navToggle.click();
			}
		});
	}

	// Smooth scrolling for in-page links
	function smoothScrollTo(target) {
		if (!target) return;
		const top = target.getBoundingClientRect().top + window.scrollY - 70;
		window.scrollTo({ top, behavior: 'smooth' });
	}
	qsa('[data-scroll],[data-scroll-to]').forEach(el => {
		el.addEventListener('click', e => {
			const href = el.getAttribute('href') || el.getAttribute('data-scroll-to');
			if (href && href.startsWith('#')) {
				const target = qs(href);
				if (target) {
					e.preventDefault();
					smoothScrollTo(target);
					if (navList.classList.contains('active')) navToggle.click();
				}
			}
		});
	});

	// Intersection Observer for reveal animations
	const io = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('is-in');
				io.unobserve(entry.target);
			}
		});
	}, { threshold: 0.2 });
	qsa('section, .menu-card, .bev-group, .t-card').forEach(el => {
		el.setAttribute('data-inview','');
		io.observe(el);
	});

	// Auto scroll testimonials (marquee style with pause on hover)
	const track = qs('.testimonial-track');
	if (track) {
		let autoScroll; let isPaused = false;
		const start = () => {
			autoScroll = requestAnimationFrame(step);
		};
		const step = () => {
			if (!isPaused) {
				track.scrollLeft += 0.5; // speed
				if (track.scrollLeft + track.clientWidth >= track.scrollWidth - 1) {
					track.scrollLeft = 0; // loop
				}
			}
			autoScroll = requestAnimationFrame(step);
		};
		track.addEventListener('mouseenter', () => { isPaused = true; });
		track.addEventListener('mouseleave', () => { isPaused = false; });
		start();
	}

	// Back to top visibility
	const toTop = qs('.to-top');
	if (toTop) {
		const toggleToTop = () => {
			const show = window.scrollY > 900;
			toTop.style.opacity = show ? '1' : '0';
			toTop.style.pointerEvents = show ? 'auto' : 'none';
		};
		toggleToTop();
		window.addEventListener('scroll', toggleToTop, { passive: true });
	}

	// Basic form submission (demo)
	const form = qs('.booking-form');
	if (form) {
		form.addEventListener('submit', e => {
			e.preventDefault();
			const data = Object.fromEntries(new FormData(form).entries());
			console.info('Booking form data (demo):', data);
			form.reset();
			const btn = form.querySelector('button[type="submit"]');
			if (btn) {
				btn.disabled = true;
				btn.textContent = 'Sent!';
				setTimeout(() => { btn.disabled = false; btn.textContent = 'Send Enquiry'; }, 2500);
			}
		});
	}
})();
