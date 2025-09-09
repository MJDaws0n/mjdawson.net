// main.js — interactions (theme + mobile nav)
(function() {
  const root = document.documentElement;
  const themeBtn = document.getElementById('theme-toggle');
  const navToggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.nav');

  function getTheme() {
    return root.getAttribute('data-theme') || 'dark';
  }

  function setTheme(next) {
    root.setAttribute('data-theme', next);
    try { localStorage.setItem('theme', next); } catch (e) {}
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
})();
