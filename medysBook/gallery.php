<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery – Medy's Catering</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/style.css" />
  <style>
    .mc-lightbox { display:none;position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:9999;align-items:center;justify-content:center;flex-direction:column; }
    .mc-lightbox.active { display:flex; }
    .mc-lightbox img { max-width:90vw;max-height:80vh;border-radius:12px;box-shadow:0 8px 40px rgba(0,0,0,0.5); }
    .mc-lightbox-close { position:absolute;top:1.5rem;right:2rem;color:#fff;font-size:2rem;cursor:pointer;background:none;border:none;line-height:1; }
    .mc-lightbox-caption { color:rgba(255,255,255,0.8);margin-top:1rem;font-family:'Playfair Display',serif;font-size:1rem; }
  </style>
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
          <li class="nav-item"><a class="nav-link active" href="gallery.php">Gallery</a></li>
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
        <a href="index.php">Home</a> / <span>Gallery</span>
      </nav>
      <h1 class="animate-fade-up">Event <span style="color:var(--mc-gold)">Gallery</span></h1>
      <p class="animate-fade-up delay-1 mt-2">A showcase of our past events and culinary creations</p>
    </div>
  </section>

  <section class="py-5 mc-section">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
        <button class="mc-btn-primary mc-filter-btn" data-filter="all">All</button>
        <button class="mc-btn-outline-red mc-filter-btn" data-filter="wedding">Weddings</button>
        <button class="mc-btn-outline-red mc-filter-btn" data-filter="corporate">Corporate</button>
        <button class="mc-btn-outline-red mc-filter-btn" data-filter="birthday">Birthdays</button>
        <button class="mc-btn-outline-red mc-filter-btn" data-filter="school">School Events</button>
        <button class="mc-btn-outline-red mc-filter-btn" data-filter="food">Food &amp; Setup</button>
      </div>
      <div class="row g-3">
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="wedding"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/37416036/pexels-photo-37416036.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Wedding Reception Catering" data-caption="Wedding Reception – Buffet &amp; Food Setup" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Wedding Reception</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="wedding"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/32644053/pexels-photo-32644053.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Wedding Catering Table" data-caption="Wedding Catering – Table with Dishes" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Wedding Setup</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="corporate"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/18749086/pexels-photo-18749086.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Corporate Catering Buffet" data-caption="Corporate Event – Buffet Catering Service" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Corporate Catering</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="corporate"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/32805961/pexels-photo-32805961.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Catering Staff Serving" data-caption="Company Event – Catering Staff in Action" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Company Anniversary</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="birthday"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/31972322/pexels-photo-31972322.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Birthday Party Catering Table" data-caption="Birthday Party – Catering Food Table" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Birthday Celebration</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="birthday"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/34593744/pexels-photo-34593744.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Dessert Catering Service" data-caption="Debut &amp; Birthday – Dessert Catering" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Debut Party</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="school"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/35247187/pexels-photo-35247187.jpeg?auto=compress&cs=tinysrgb&w=600" alt="School Event Buffet Catering" data-caption="Graduation Reception – Buffet Catering" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Graduation Reception</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="school"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/36627087/pexels-photo-36627087.jpeg?auto=compress&cs=tinysrgb&w=600" alt="School Catering Food Trays" data-caption="School Recognition – Catering Food Trays" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">School Recognition</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="food"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/2291367/pexels-photo-2291367.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Stainless Steel Chafing Dish Buffet" data-caption="Buffet Setup – Stainless Chafing Dishes" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Buffet Setup</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="food"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/12253094/pexels-photo-12253094.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Rice and Chafing Dish Buffet" data-caption="Catering Buffet – Rice &amp; Dishes in Warmers" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Food Presentation</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="food"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/4007058/pexels-photo-4007058.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Chicken in Catering Trays" data-caption="Catering Tray – Grilled Chicken" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Catering Trays</p></div>
        <div class="col-6 col-md-4 col-lg-3 mc-gallery-item" data-category="food"><div class="mc-gallery-full-thumb" onclick="openLightbox(this)"><img src="https://images.pexels.com/photos/18749077/pexels-photo-18749077.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Buffet Display Warmers" data-caption="Catering Display – Food Warmers" /><div class="mc-gallery-full-overlay"><i class="bi bi-zoom-in"></i></div></div><p class="small text-center mt-2 mc-body-text">Dessert Station</p></div>
      </div>
    </div>
  </section>

  <div class="mc-lightbox" id="lightbox">
    <button class="mc-lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></button>
    <img id="lightboxImg" src="" alt="" />
    <p class="mc-lightbox-caption" id="lightboxCaption"></p>
  </div>

  <section class="py-4 mc-section-red text-white text-center">
    <div class="container">
      <h4 class="mc-section-title text-white mb-3">Want Your Event to Look Like <span style="color:var(--mc-gold)">This?</span></h4>
      <a href="booking.php" class="btn mc-btn-outline btn-lg px-5">Book Your Event Now</a>
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
      <p class="text-center text-white-50 small mb-0">&copy; 2026 Medy's Catering. All rights reserved. | Developed for Academic Research &ndash; PUP</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
  <script src="assets/script.js"></script>
  <script>
    function openLightbox(thumbEl) {
      const img = thumbEl.querySelector('img');
      document.getElementById('lightboxImg').src = img.src;
      document.getElementById('lightboxImg').alt = img.alt;
      document.getElementById('lightboxCaption').textContent = img.getAttribute('data-caption') || img.alt;
      document.getElementById('lightbox').classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
      document.getElementById('lightbox').classList.remove('active');
      document.body.style.overflow = '';
    }
    document.getElementById('lightbox').addEventListener('click', function(e) {
      if (e.target == this) closeLightbox();
    });
    document.addEventListener('keydown', function(e) {
      if (e.key == 'Escape') closeLightbox();
    });
  </script>
</body>
</html>
