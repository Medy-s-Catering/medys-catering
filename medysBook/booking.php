<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book an Event – Medy's Catering</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark sticky-top mc-navbar">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <span class="mc-logo-icon"><i class="bi bi-award-fill"></i></span>
        <span class="mc-brand-text">Medy's<strong> Catering</strong></span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          <li class="nav-item ms-lg-3"><a class="btn mc-btn-outline" href="booking.php">Book Now</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="mc-page-hero">
    <div class="container">
      <nav aria-label="breadcrumb" class="mc-breadcrumb mb-3">
        <a href="index.php">Home</a> / <span>Book an Event</span>
      </nav>
      <h1 class="animate-fade-up">Book Your <span style="color:var(--mc-gold)">Event</span></h1>
      <p class="animate-fade-up delay-1 mt-2">Fill out the form below and our team will confirm your booking within 24 hours.</p>
    </div>
  </section>

  <section class="py-5 mc-section">
    <div class="container">
      <div class="row g-5">

        <div class="col-lg-8">
          <div class="mc-booking-form-card">
            <p class="mc-section-pre">Booking Request</p>
            <h3 class="mc-section-title mb-1">Event <span class="mc-accent">Details</span></h3>
            <p class="mc-body-text mb-4">Please provide the information below. Fields marked with * are required.</p>

            <div id="bookingSuccess" class="alert alert-success d-none" role="alert">
              <i class="bi bi-check-circle-fill me-2"></i>
              <strong>Booking Request Submitted!</strong> Our team will contact you within 24 hours to confirm your booking. Thank you!
              <div id="bookingClientIdBox" class="mt-2 d-none" style="background:rgba(255,255,255,0.6);border-radius:8px;padding:0.5rem 0.75rem;font-size:0.9rem;">
                Your Client ID: <strong id="bookingClientIdValue" style="letter-spacing:0.05em;"></strong> — please save this for your reference.
              </div>
            </div>

            <form id="bookingForm" novalidate>
              <h6 class="fw-bold text-danger mb-3 mt-2"><span class="mc-booking-step">1</span> Client Information</h6>
              <div class="row g-3 mb-4">
                <div class="col-md-6"><label class="mc-form-label">Full Name *</label><input type="text" name="client_name" class="mc-form-control form-control" placeholder="Your full name" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Email Address *</label><input type="email" name="email" class="mc-form-control form-control" placeholder="your@email.com" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Phone Number *</label><input type="tel" name="phone" class="mc-form-control form-control" placeholder="09XX XXX XXXX" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Alternative Contact</label><input type="tel" name="alt_phone" class="mc-form-control form-control" placeholder="Optional" /></div>
              </div>

              <h6 class="fw-bold text-danger mb-3"><span class="mc-booking-step">2</span> Event Details</h6>
              <div class="row g-3 mb-4">
                <div class="col-md-6"><label class="mc-form-label">Type of Event *</label><select name="event_type" class="mc-form-control form-select" required><option value="">Select event type...</option><option value="Corporate Event">Corporate Event</option><option value="Wedding / Reception">Wedding / Reception</option><option value="Birthday / Debut">Birthday / Debut</option><option value="School Activity">School Activity</option><option value="Family Reunion">Family Reunion</option><option value="Other">Other</option></select></div>
                <div class="col-md-6"><label class="mc-form-label">Package *</label><select name="package" class="mc-form-control form-select" required><option value="">Select package...</option><option value="Basic">Basic Package</option><option value="Standard">Standard Package</option><option value="Premium">Premium Package</option><option value="Custom">Custom Package (discuss with team)</option></select></div>
                <div class="col-md-6"><label class="mc-form-label">Event Date *</label><input type="date" name="event_date" class="mc-form-control form-control" min="<?php echo date('Y-m-d'); ?>" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Event Time *</label><input type="time" name="event_time" class="mc-form-control form-control" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Number of Guests *</label><input type="number" name="guest_count" class="mc-form-control form-control" placeholder="e.g. 100" min="1" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Event Duration</label><select name="duration" class="mc-form-control form-select"><option value="">Select duration...</option><option>2 hours</option><option>4 hours</option><option>6 hours</option><option>8 hours</option><option>Full day</option></select></div>
              </div>

              <h6 class="fw-bold text-danger mb-3"><span class="mc-booking-step">3</span> Venue &amp; Preferences</h6>
              <div class="row g-3 mb-4">
                <div class="col-12"><label class="mc-form-label">Event Venue / Location *</label><input type="text" name="venue" class="mc-form-control form-control" placeholder="Full address of the event venue" required /></div>
                <div class="col-md-6"><label class="mc-form-label">Do you need venue decoration?</label><select name="decoration" class="mc-form-control form-select"><option value="no">No</option><option value="yes">Yes – include in package</option><option value="discuss">Discuss with team</option></select></div>
                <div class="col-md-6"><label class="mc-form-label">Theme / Color Preference</label><input type="text" name="theme" class="mc-form-control form-control" placeholder="e.g. Red &amp; Gold, Garden Party" /></div>
                <div class="col-12"><label class="mc-form-label">Special Requests / Dietary Restrictions</label><textarea name="special_requests" class="mc-form-control form-control" rows="4" placeholder="Any allergies, special dishes, or additional requests..."></textarea></div>
              </div>

              <div class="row g-3 mb-4">
                <div class="col-md-6"><label class="mc-form-label">How did you hear about us?</label><select name="referral" class="mc-form-control form-select"><option value="">Select...</option><option>Facebook / Social Media</option><option>Word of Mouth / Referral</option><option>Previous Client</option><option>Google Search</option><option>Other</option></select></div>
              </div>

              <div class="mc-terms-box mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="termsCheck" />
                  <label class="form-check-label mc-body-text" for="termsCheck">
                    I have read and agree to the <a href="#" class="mc-terms-link" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a> of Medy's Catering.
                  </label>
                </div>
                <div id="termsError" class="mc-field-error d-none"><i class="bi bi-exclamation-circle-fill me-1"></i>You must agree to the Terms and Conditions before submitting.</div>
              </div>

              <button type="button" class="btn mc-btn-primary btn-lg w-100 py-3" onclick="openConfirmModal()">
                <i class="bi bi-calendar2-check-fill me-2"></i>Submit Booking Request
              </button>
            </form>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="mc-booking-form-card mb-4">
            <h5 class="mc-service-title mb-3"><i class="bi bi-info-circle mc-accent me-2"></i>Booking Process</h5>
            <div class="d-flex align-items-start gap-3 mb-3"><span class="mc-booking-step flex-shrink-0">1</span><div><p class="fw-bold mb-1">Submit Request</p><p class="mc-body-text small mb-0">Fill out the booking form with your event details.</p></div></div>
            <div class="d-flex align-items-start gap-3 mb-3"><span class="mc-booking-step flex-shrink-0">2</span><div><p class="fw-bold mb-1">Team Confirmation</p><p class="mc-body-text small mb-0">Our team will contact you within 24 hours to confirm availability.</p></div></div>
            <div class="d-flex align-items-start gap-3 mb-3"><span class="mc-booking-step flex-shrink-0">3</span><div><p class="fw-bold mb-1">Finalize Details</p><p class="mc-body-text small mb-0">Discuss menu, setup, and timeline with your dedicated coordinator.</p></div></div>
            <div class="d-flex align-items-start gap-3"><span class="mc-booking-step flex-shrink-0">4</span><div><p class="fw-bold mb-1">Enjoy Your Event!</p><p class="mc-body-text small mb-0">Relax and let Medy's team handle everything on your special day.</p></div></div>
          </div>
          <div class="mc-booking-form-card mb-4" style="background:var(--mc-off-white)">
            <h5 class="mc-service-title mb-3"><i class="bi bi-telephone-fill mc-accent me-2"></i>Need Help?</h5>
            <p class="mc-body-text small">Prefer to book over the phone? Call or message us directly:</p>
            <p class="fw-bold mc-accent mb-1">0999 864 8368</p>
            <p class="mc-body-text small mb-3">mdavesulabo@yahoo.com</p>
            <a href="contact.php" class="btn mc-btn-outline-red w-100">Contact Us</a>
          </div>
          <div class="mc-booking-form-card mb-4" style="background:var(--mc-off-white)">
            <h5 class="mc-service-title mb-3"><i class="bi bi-credit-card-fill mc-accent me-2"></i>Payment Methods</h5>
            <p class="mc-body-text small">We accept the following payment methods:</p>
            <ul class="mc-body-text small ps-3 mb-0"><li>Cash</li><li>Bank Transfer</li><li>GCash</li></ul>
          </div>
          <div class="mc-booking-form-card" style="border-color:var(--mc-red)">
            <h5 class="mc-service-title mb-3"><i class="bi bi-check-circle mc-accent me-2"></i>Why Book With Us?</h5>
            <ul class="mc-body-text small ps-3"><li class="mb-2">Experienced &amp; professional team</li><li class="mb-2">Customizable packages for any budget</li><li class="mb-2">Real-time event coordination updates</li><li class="mb-2">Quality food &amp; beautiful presentation</li><li class="mb-2">Trusted by 500+ happy clients</li></ul>
          </div>
        </div>

      </div>
    </div>
  </section>

  <footer class="mc-footer pt-5 pb-3">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4"><div class="mc-brand-text fs-4 mb-2"><i class="bi bi-award-fill mc-accent me-2"></i>Medy's<strong> Catering</strong></div><p class="text-white-50">Your trusted partner for catering and event management services.</p><div class="d-flex gap-3 mt-3"><a href="https://www.facebook.com/profile.php?id=100047324067100" target="_blank" rel="noopener" class="mc-social-icon"><i class="bi bi-facebook"></i></a><a href="#" class="mc-social-icon"><i class="bi bi-instagram"></i></a><a href="https://m.me/100047324067100" target="_blank" rel="noopener" class="mc-social-icon"><i class="bi bi-messenger"></i></a></div></div>
        <div class="col-6 col-lg-2"><h6 class="mc-footer-heading">Quick Links</h6><ul class="mc-footer-links"><li><a href="index.php">Home</a></li><li><a href="about.php">About</a></li><li><a href="services.php">Services</a></li><li><a href="gallery.php">Gallery</a></li><li><a href="feedback.php">Feedback</a></li><li><a href="contact.php">Contact</a></li></ul></div>
        <div class="col-6 col-lg-2"><h6 class="mc-footer-heading">Services</h6><ul class="mc-footer-links"><li><a href="services.php">Corporate Events</a></li><li><a href="services.php">Weddings</a></li><li><a href="services.php">Birthdays</a></li><li><a href="services.php">School Events</a></li><li><a href="services.php">Buffet Catering</a></li></ul></div>
        <div class="col-lg-4"><h6 class="mc-footer-heading">Contact Us</h6><ul class="mc-footer-links"><li><i class="bi bi-geo-alt-fill mc-accent me-2"></i>Trapiche 2, Tanauan City, Batangas, Philippines, 4232</li><li><i class="bi bi-telephone-fill mc-accent me-2"></i>0999 864 8368</li><li><i class="bi bi-envelope-fill mc-accent me-2"></i>mdavesulabo@yahoo.com</li><li><i class="bi bi-clock-fill mc-accent me-2"></i>Mon–Sat: 8:00 AM – 5:00 PM</li></ul></div>
      </div>
      <hr class="mc-footer-hr mt-4" />
      <p class="text-center text-white-50 small mb-0">&copy; 2025 Medy's Catering. All rights reserved. | Developed for Academic Research &ndash; PUP</p>
    </div>
  </footer>

  <!-- Terms Modal -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content" style="border-radius:16px;overflow:hidden;">
        <div class="modal-header" style="background:var(--mc-red-dark);border:none;">
          <h5 class="modal-title text-white fw-bold" id="termsModalLabel" style="font-family:'Playfair Display',serif;"><i class="bi bi-file-text-fill me-2" style="color:var(--mc-gold)"></i>Terms and Conditions</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4" style="font-family:'Lato',sans-serif;font-size:0.95rem;color:#374151;line-height:1.8;">
          <p style="font-size:0.85rem;color:#6B7280;margin-bottom:1.5rem;">Last updated: 2025 &nbsp;|&nbsp; Medy's Catering, Trapiche 2, Tanauan City, Batangas, Philippines</p>
          <p>Please read these Terms and Conditions carefully before submitting your booking request.</p>
          <h6 style="color:var(--mc-red);font-weight:700;margin-top:1.5rem;">1. Booking Request</h6>
          <p>Submitting the online booking form does <strong>not</strong> guarantee a confirmed reservation. All booking requests are subject to availability and must be confirmed by Medy's Catering staff within <strong>24 hours</strong>.</p>
          <h6 style="color:var(--mc-red);font-weight:700;margin-top:1.5rem;">2. Client Responsibilities</h6>
          <p>The client is responsible for providing accurate and complete information in the booking form. Medy's Catering shall not be held liable for any issues arising from incorrect or incomplete information.</p>
          <h6 style="color:var(--mc-red);font-weight:700;margin-top:1.5rem;">3. Cancellation Policy</h6>
          <p>Cancellations must be made at least <strong>7 days</strong> before the event date. Cancellations within 7 days may result in partial or full forfeiture of the deposit.</p>
          <h6 style="color:var(--mc-red);font-weight:700;margin-top:1.5rem;">4. Privacy and Data Use</h6>
          <p>Personal information submitted through the booking form will be used solely for processing your booking and will not be shared with third parties without your consent.</p>
        </div>
        <div class="modal-footer" style="border-top:1px solid #f0e8e6;">
          <button type="button" class="btn mc-btn-outline-red px-4" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn mc-btn-primary px-5" onclick="acceptTerms()"><i class="bi bi-check-circle-fill me-2"></i>I Agree</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirm Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius:16px;overflow:hidden;">
        <div class="modal-header" style="background:var(--mc-red-dark);border:none;">
          <h5 class="modal-title text-white fw-bold" id="confirmModalLabel" style="font-family:'Playfair Display',serif;"><i class="bi bi-calendar2-check-fill me-2" style="color:var(--mc-gold)"></i>Confirm Your Booking</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <p class="mc-body-text mb-3">Please review your booking details before submitting.</p>
          <div class="mc-confirm-table">
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-person-fill me-2" style="color:var(--mc-red)"></i>Name</span><span class="mc-confirm-value" id="cs-name">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-envelope-fill me-2" style="color:var(--mc-red)"></i>Email</span><span class="mc-confirm-value" id="cs-email">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-telephone-fill me-2" style="color:var(--mc-red)"></i>Phone</span><span class="mc-confirm-value" id="cs-phone">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-tag-fill me-2" style="color:var(--mc-red)"></i>Event Type</span><span class="mc-confirm-value" id="cs-event">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-box-seam-fill me-2" style="color:var(--mc-red)"></i>Package</span><span class="mc-confirm-value" id="cs-package">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-calendar3 me-2" style="color:var(--mc-red)"></i>Date</span><span class="mc-confirm-value" id="cs-date">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-clock-fill me-2" style="color:var(--mc-red)"></i>Time</span><span class="mc-confirm-value" id="cs-time">—</span></div>
            <div class="mc-confirm-row"><span class="mc-confirm-label"><i class="bi bi-people-fill me-2" style="color:var(--mc-red)"></i>Guests</span><span class="mc-confirm-value" id="cs-guests">—</span></div>
            <div class="mc-confirm-row" style="border-bottom:none;"><span class="mc-confirm-label"><i class="bi bi-geo-alt-fill me-2" style="color:var(--mc-red)"></i>Venue</span><span class="mc-confirm-value" id="cs-venue">—</span></div>
          </div>
        </div>
        <div class="modal-footer" style="border-top:1px solid #f0e8e6;gap:0.75rem;">
          <button type="button" class="btn mc-btn-outline-red px-4" data-bs-dismiss="modal"><i class="bi bi-pencil-fill me-1"></i> Edit Details</button>
          <button type="button" class="btn mc-btn-primary px-5" onclick="submitBookingForm()"><i class="bi bi-send-fill me-2"></i>Yes, Submit Request</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
  <script src="assets/script.js"></script>
  <style>
    .mc-terms-box{background:var(--mc-off-white);border:1.5px solid #ecdad8;border-radius:10px;padding:1rem 1.25rem}
    .mc-terms-link{color:var(--mc-red);font-weight:700;text-decoration:underline;text-underline-offset:2px}
    .mc-terms-box.terms-accepted{border-color:#10b981;background:#f0fdf4}
    .mc-field-error{color:var(--mc-red);font-size:0.82rem;font-weight:600;margin-top:0.5rem}
    .mc-confirm-table{border:1.5px solid #ecdad8;border-radius:10px;overflow:hidden}
    .mc-confirm-row{display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;padding:0.6rem 1rem;border-bottom:1px solid #f5ebe9;font-size:0.88rem}
    .mc-confirm-row:nth-child(even){background:#fdf7f6}
    .mc-confirm-label{color:#6B7280;font-weight:600;white-space:nowrap;min-width:110px}
    .mc-confirm-value{color:#111827;font-weight:600;text-align:right;word-break:break-word}
  </style>
  <script>
    function acceptTerms() {
      document.getElementById('termsCheck').checked = true;
      document.getElementById('termsError').classList.add('d-none');
      document.querySelector('.mc-terms-box').classList.add('terms-accepted');
      bootstrap.Modal.getInstance(document.getElementById('termsModal')).hide();
    }
    document.addEventListener('DOMContentLoaded', function() {
      const chk = document.getElementById('termsCheck');
      const box = document.querySelector('.mc-terms-box');
      chk.addEventListener('change', function() {
        if (chk.checked) { box.classList.add('terms-accepted'); document.getElementById('termsError').classList.add('d-none'); }
        else { box.classList.remove('terms-accepted'); }
      });
      document.querySelectorAll('#bookingForm [required]').forEach(function(field) {
        field.addEventListener('input', function() { if (field.value.trim()) field.classList.remove('is-invalid'); });
      });
    });
    function formatDate(val) {
      if (!val) return '—';
      const d = new Date(val + 'T00:00:00');
      return d.toLocaleDateString('en-PH', { year:'numeric', month:'long', day:'numeric' });
    }
    function formatTime(val) {
      if (!val) return '—';
      const [h, m] = val.split(':').map(Number);
      const ampm = h >= 12 ? 'PM' : 'AM';
      return `${h % 12 || 12}:${String(m).padStart(2,'0')} ${ampm}`;
    }
    function validateForm() {
      const form = document.getElementById('bookingForm');
      let valid = true;
      form.querySelectorAll('[required]').forEach(function(field) {
        if (!field.value.trim()) { field.classList.add('is-invalid'); valid = false; }
        else { field.classList.remove('is-invalid'); }
      });
      const dateField = form.querySelector('[name="event_date"]');
      if (dateField && dateField.value) {
        const today = new Date(); today.setHours(0, 0, 0, 0);
        const selected = new Date(dateField.value + 'T00:00:00');
        if (selected < today) { dateField.classList.add('is-invalid'); valid = false; }
      }
      if (!document.getElementById('termsCheck').checked) {
        document.getElementById('termsError').classList.remove('d-none');
        document.querySelector('.mc-terms-box').scrollIntoView({ behavior:'smooth', block:'center' });
        valid = false;
      }
      return valid;
    }
    function openConfirmModal() {
      if (!validateForm()) { const first = document.querySelector('#bookingForm .is-invalid, #termsError:not(.d-none)'); if (first) first.scrollIntoView({ behavior:'smooth', block:'center' }); return; }
      const fd = new FormData(document.getElementById('bookingForm'));
      document.getElementById('cs-name').textContent = fd.get('client_name') || '—';
      document.getElementById('cs-email').textContent = fd.get('email') || '—';
      document.getElementById('cs-phone').textContent = fd.get('phone') || '—';
      document.getElementById('cs-event').textContent = fd.get('event_type') || '—';
      document.getElementById('cs-package').textContent = fd.get('package') || '—';
      document.getElementById('cs-date').textContent = formatDate(fd.get('event_date'));
      document.getElementById('cs-time').textContent = formatTime(fd.get('event_time'));
      document.getElementById('cs-guests').textContent = fd.get('guest_count') + ' guests';
      document.getElementById('cs-venue').textContent = fd.get('venue') || '—';
      new bootstrap.Modal(document.getElementById('confirmModal')).show();
    }
    function submitBookingForm() {
      bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
      document.getElementById('bookingForm').dispatchEvent(new Event('submit', { cancelable:true, bubbles:true }));
    }
  </script>
</body>
</html>
