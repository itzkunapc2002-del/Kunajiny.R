/* =========================================
   PORTFOLIO JS — Kunajiny Rathakrishnan
========================================= */
'use strict';

document.addEventListener('DOMContentLoaded', () => {

  /* ── CUSTOM CURSOR ── */
  const dot  = document.getElementById('curDot');
  const ring = document.getElementById('curRing');
  let mx = 0, my = 0, rx = 0, ry = 0;

  document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    dot.style.left = mx + 'px';
    dot.style.top  = my + 'px';
  });
  (function track() {
    rx += (mx - rx) * .13;
    ry += (my - ry) * .13;
    ring.style.left = rx + 'px';
    ring.style.top  = ry + 'px';
    requestAnimationFrame(track);
  })();

  const hoverEls = document.querySelectorAll('a, button, .pcard, .tpill, .ac');
  hoverEls.forEach(el => {
    el.addEventListener('mouseenter', () => {
      ring.style.transform = 'translate(-50%,-50%) scale(1.8)';
      ring.style.opacity = '.7';
      ring.style.borderColor = 'var(--accent)';
    });
    el.addEventListener('mouseleave', () => {
      ring.style.transform = 'translate(-50%,-50%) scale(1)';
      ring.style.opacity = '.45';
    });
  });

  /* ── NAVBAR SCROLL ── */
  const header = document.getElementById('header');
  const stt    = document.getElementById('stt');

  window.addEventListener('scroll', () => {
    const y = window.scrollY;
    header.classList.toggle('scrolled', y > 60);
    stt.classList.toggle('show', y > 400);

    // Active nav highlighting
    document.querySelectorAll('section[id]').forEach(sec => {
      const top = sec.offsetTop - 120;
      const bot = top + sec.offsetHeight;
      const link = document.querySelector(`.nav-a[href="#${sec.id}"]`);
      if (link) link.classList.toggle('active', y >= top && y < bot);
    });
  });

  stt.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  /* ── HAMBURGER ── */
  const burger = document.getElementById('burger');
  const nav    = document.getElementById('nav');
  burger.addEventListener('click', () => nav.classList.toggle('open'));
  nav.querySelectorAll('.nav-a').forEach(a => {
    a.addEventListener('click', () => nav.classList.remove('open'));
  });

  /* ── TYPED TEXT ── */
  const roles   = ['Web Developer', 'Frontend Craftsman', 'PHP Developer', 'UI Enthusiast'];
  const typedEl = document.getElementById('typed');
  let ri = 0, ci = 0, del = false;

  function typeLoop() {
    const word = roles[ri];
    typedEl.textContent = del ? word.slice(0, --ci) : word.slice(0, ++ci);
    if (!del && ci === word.length) { del = true; setTimeout(typeLoop, 1800); return; }
    if (del && ci === 0) { del = false; ri = (ri + 1) % roles.length; }
    setTimeout(typeLoop, del ? 50 : 85);
  }
  typeLoop();

  /* ── FADE-UP REVEAL ── */
  const observer = new IntersectionObserver(entries => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        setTimeout(() => entry.target.classList.add('vis'), i * 70);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  // Trigger hero fade-ups immediately
  setTimeout(() => {
    document.querySelectorAll('.hero .fade-up').forEach((el, i) => {
      setTimeout(() => el.classList.add('vis'), 150 + i * 120);
    });
  }, 100);

  /* ── SKILL BAR ANIMATION ── */
  const fillObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        setTimeout(() => { e.target.style.width = e.target.dataset.w + '%'; }, 250);
        fillObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.4 });
  document.querySelectorAll('.sk-fill').forEach(el => fillObs.observe(el));

  /* ── PROJECT CARD 3D TILT ── */
  document.querySelectorAll('.pcard').forEach(card => {
    card.addEventListener('mousemove', e => {
      const r = card.getBoundingClientRect();
      const x = ((e.clientX - r.left) / r.width  - .5) * 10;
      const y = ((e.clientY - r.top)  / r.height - .5) * -10;
      card.style.transform = `translateY(-8px) rotateY(${x}deg) rotateX(${y}deg)`;
      card.style.transition = 'transform .08s';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
      card.style.transition = 'transform .5s var(--ease)';
    });
  });

  /* ── SMOOTH SCROLL ── */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    });
  });

  /* ── FORM HIGHLIGHT ON ERROR ── */
  const form = document.getElementById('cForm');
  if (form) {
    form.addEventListener('submit', e => {
      let ok = true;
      form.querySelectorAll('input[required], textarea[required]').forEach(inp => {
        if (!inp.value.trim()) {
          ok = false;
          inp.style.borderColor = '#ff5f6d';
          inp.style.boxShadow   = '0 0 0 3px rgba(255,95,109,.18)';
          setTimeout(() => { inp.style.borderColor = ''; inp.style.boxShadow = ''; }, 2500);
        }
      });
      if (!ok) e.preventDefault();
    });
  }

  /* ── TECH PILLS HOVER RIPPLE ── */
  document.querySelectorAll('.tpill').forEach(pill => {
    pill.addEventListener('click', () => {
      pill.style.transform = 'scale(.95)';
      setTimeout(() => { pill.style.transform = ''; }, 150);
    });
  });

  /* ── PAGE LOAD COUNTER ANIMATION ── */
  function animateCounter(el) {
    const target = parseInt(el.textContent);
    if (isNaN(target)) return;
    let count = 0;
    const step = Math.ceil(target / 40);
    const t = setInterval(() => {
      count = Math.min(count + step, target);
      el.textContent = count + (el.dataset.suffix || '');
      if (count >= target) clearInterval(t);
    }, 30);
  }
  const counterObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.hs span').forEach(s => animateCounter(s));
        counterObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.5 });
  const statsEl = document.querySelector('.hero-stats');
  if (statsEl) counterObs.observe(statsEl);

});
