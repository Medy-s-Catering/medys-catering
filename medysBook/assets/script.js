const API = '/medysBook/api';

document.addEventListener('DOMContentLoaded', function () {

  // ---- SCROLL TO TOP BUTTON ----
  const scrollBtn = document.createElement('button');
  scrollBtn.className = 'mc-scroll-top';
  scrollBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
  scrollBtn.setAttribute('aria-label', 'Scroll to top');
  document.body.appendChild(scrollBtn);

  window.addEventListener('scroll', () => {
    scrollBtn.classList.toggle('visible', window.scrollY > 400);
  });

  scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  const navbar = document.querySelector('.mc-navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 60) {
        navbar.style.padding = '0.4rem 0';
        navbar.style.boxShadow = '0 2px 30px rgba(0,0,0,0.35)';
      } else {
        navbar.style.padding = '0.75rem 0';
        navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.25)';
      }
    });
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }, i * 80);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

  document.querySelectorAll('.mc-service-card, .mc-testimonial-card, .mc-team-card, .mc-value-item').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(24px)';
    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(el);
  });

  // ---- BOOKING FORM SUBMISSION ----
  const bookingForm = document.getElementById('bookingForm');
  if (bookingForm) {
    bookingForm.addEventListener('submit', async function (e) {
      e.preventDefault();
      const btn = bookingForm.querySelector('[type="submit"]');
      if (btn) btn.disabled = true;

      const data = Object.fromEntries(new FormData(bookingForm).entries());

      try {
        const res = await fetch(API + '/bookings', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify(data),
        });

        if (!res.ok) {
          const err = await res.json().catch(() => ({}));
          const msg = err.message || Object.values(err.errors || {}).flat().join(' ') || 'Submission failed.';
          alert(msg);
          return;
        }

        const result = await res.json().catch(() => ({}));

        const successAlert = document.getElementById('bookingSuccess');
        if (successAlert) {
          successAlert.classList.remove('d-none');
          bookingForm.reset();

          if (result.client_id) {
            const box = document.getElementById('bookingClientIdBox');
            const val = document.getElementById('bookingClientIdValue');
            if (box && val) {
              val.textContent = result.client_id;
              box.classList.remove('d-none');
            }
          }

          if (result.receipt_url) {
            const qrBox    = document.getElementById('bookingQrBox');
            const qrCanvas = document.getElementById('bookingQrCanvas');
            if (qrBox && qrCanvas && window.QRCode) {
              window._mcReceiptUrl = result.receipt_url;
              window._mcClientId   = result.client_id || '';
              qrBox.classList.remove('d-none');
              QRCode.toCanvas(qrCanvas, result.receipt_url, {
                width: 220, margin: 2,
                color: { dark: '#8B1A1A', light: '#ffffff' }
              });
            }
          }

          successAlert.scrollIntoView({ behavior: 'smooth' });
        }
      } catch (err) {
        alert('Network error. Please check your connection and try again.');
      } finally {
        if (btn) btn.disabled = false;
      }
    });
  }

  // ---- CONTACT FORM SUBMISSION ----
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', async function (e) {
      e.preventDefault();
      const btn = contactForm.querySelector('[type="submit"]');
      if (btn) btn.disabled = true;

      const data = Object.fromEntries(new FormData(contactForm).entries());

      try {
        const res = await fetch(API + '/contact', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify(data),
        });

        if (!res.ok) {
          const err = await res.json().catch(() => ({}));
          const msg = err.message || Object.values(err.errors || {}).flat().join(' ') || 'Submission failed.';
          alert(msg);
          return;
        }

        const successAlert = document.getElementById('contactSuccess');
        if (successAlert) {
          successAlert.classList.remove('d-none');
          contactForm.reset();
          successAlert.scrollIntoView({ behavior: 'smooth' });
        }
      } catch (err) {
        alert('Network error. Please check your connection and try again.');
      } finally {
        if (btn) btn.disabled = false;
      }
    });
  }

  // ---- FEEDBACK FORM SUBMISSION ----
  const feedbackForm = document.getElementById('feedbackForm');
  if (feedbackForm) {
    feedbackForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const starSelected = feedbackForm.querySelector('input[name="star_rating"]:checked');
      if (!starSelected) {
        const starLabel = document.getElementById('starLabel');
        if (starLabel) {
          starLabel.textContent = 'Please select a star rating.';
          starLabel.style.color = 'var(--mc-red)';
        }
        return;
      }

      const btn = feedbackForm.querySelector('[type="submit"]');
      if (btn) btn.disabled = true;

      const data = Object.fromEntries(new FormData(feedbackForm).entries());
      data.date_submitted = new Date().toISOString().split('T')[0];

      try {
        const res = await fetch(API + '/feedback', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify(data),
        });

        if (!res.ok) {
          const err = await res.json().catch(() => ({}));
          const msg = err.message || Object.values(err.errors || {}).flat().join(' ') || 'Submission failed.';
          alert(msg);
          return;
        }

        const successAlert = document.getElementById('feedbackSuccess');
        if (successAlert) {
          successAlert.classList.remove('d-none');
          feedbackForm.reset();
          document.querySelectorAll('.mc-tag-btn').forEach(b => {
            b.style.background = 'transparent';
            b.style.color = 'var(--mc-red)';
          });
          const tagInput = document.getElementById('likedTagsValue');
          if (tagInput) tagInput.value = '';
          const starLabel = document.getElementById('starLabel');
          if (starLabel) { starLabel.textContent = 'Click a star to rate'; starLabel.style.color = ''; }
          successAlert.scrollIntoView({ behavior: 'smooth' });
        }
      } catch (err) {
        alert('Network error. Please check your connection and try again.');
      } finally {
        if (btn) btn.disabled = false;
      }
    });
  }

  // ---- GALLERY FILTER ----
  const filterBtns = document.querySelectorAll('.mc-filter-btn');
  const galleryItems = document.querySelectorAll('.mc-gallery-item');

  if (filterBtns.length && galleryItems.length) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => { b.classList.remove('mc-btn-primary'); b.classList.add('mc-btn-outline-red'); });
        btn.classList.remove('mc-btn-outline-red');
        btn.classList.add('mc-btn-primary');

        const filter = btn.dataset.filter;
        galleryItems.forEach(item => {
          item.style.display = (filter == 'all' || item.dataset.category == filter) ? '' : 'none';
        });
      });
    });
  }

  // ---- STATS COUNTER ANIMATION ----
  const counters = document.querySelectorAll('.mc-stat-num');
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.innerText.replace(/\D/g, ''), 10);
        const suffix = el.innerText.replace(/[0-9]/g, '');
        let count = 0;
        const increment = Math.ceil(target / 40);
        const interval = setInterval(() => {
          count = Math.min(count + increment, target);
          el.innerText = count + suffix;
          if (count >= target) clearInterval(interval);
        }, 40);
        counterObserver.unobserve(el);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(c => counterObserver.observe(c));
});

window.downloadBookingQR = function () {
  var url = window._mcReceiptUrl;
  var id  = window._mcClientId || 'receipt';
  if (!url || !window.QRCode) return;
  QRCode.toDataURL(url, { width: 500, margin: 2, color: { dark: '#8B1A1A', light: '#ffffff' } }, function (err, dataUrl) {
    if (err) return;
    var a = document.createElement('a');
    a.download = 'medys-booking-' + id + '.png';
    a.href = dataUrl;
    a.click();
  });
};
