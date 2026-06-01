<?php
require __DIR__ . '/config/db.php';

$client_id = trim($_GET['id'] ?? '');
$booking   = null;

if ($client_id !== '') {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE client_id = ?");
    $stmt->execute([$client_id]);
    $booking = $stmt->fetch();
}

$status_cfg = [
    'pending'   => ['label' => 'Pending Confirmation', 'icon' => 'bi-hourglass-split',      'color' => '#d97706', 'bg' => '#fffbeb', 'border' => '#fcd34d'],
    'confirmed' => ['label' => 'Confirmed',            'icon' => 'bi-check-circle-fill',     'color' => '#16a34a', 'bg' => '#f0fdf4', 'border' => '#86efac'],
    'completed' => ['label' => 'Completed',            'icon' => 'bi-patch-check-fill',      'color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#93c5fd'],
    'cancelled' => ['label' => 'Cancelled',            'icon' => 'bi-x-circle-fill',         'color' => '#dc2626', 'bg' => '#fef2f2', 'border' => '#fca5a5'],
];

$status_msg = [
    'pending'   => 'Your booking request has been received. Our team will contact you within <strong>24 hours</strong> to confirm availability.',
    'confirmed' => 'Your booking is <strong>confirmed!</strong> Our team will be in touch with the final event details.',
    'completed' => 'This event has been completed. Thank you for choosing Medy\'s Catering!',
    'cancelled' => 'This booking has been cancelled. Please contact us if you have any questions.',
];

$status     = $booking['status']     ?? '';
$cfg        = $status_cfg[$status]   ?? $status_cfg['pending'];
$msg        = $status_msg[$status]   ?? '';

$scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$receipt_url = $booking
    ? $scheme . '://' . $_SERVER['HTTP_HOST'] . '/medysBook/booking-receipt.php?id=' . urlencode($client_id)
    : '';

function fmt_date($d) { return $d ? date('F j, Y', strtotime($d)) : '—'; }
function fmt_time($t) { return $t ? date('g:i A', strtotime($t)) : '—'; }

function parse_sr(string $sr): array {
    $lines = array_filter(array_map('trim', explode("\n", $sr)));
    $food = ''; $addons = []; $rest = [];
    foreach ($lines as $line) {
        if (str_starts_with($line, 'Food Order: ') || preg_match('/^Party Tray \(\d+ Pax\):/', $line)) {
            $food = $line;
        } elseif (str_starts_with($line, 'Add-Ons: ')) {
            $addons = array_values(array_filter(array_map('trim', explode(', ', substr($line, 9)))));
        } else {
            $rest[] = $line;
        }
    }
    return ['food' => $food, 'addons' => $addons, 'requests' => trim(implode("\n", $rest))];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Receipt – Medy's Catering</title>
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
        <a href="index.php">Home</a> / <span>Booking Receipt</span>
      </nav>
      <h1 class="animate-fade-up">Booking <span style="color:var(--mc-gold)">Receipt</span></h1>
      <p class="animate-fade-up delay-1 mt-2">View your booking details and current status below.</p>
    </div>
  </section>

  <section class="py-5 mc-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">

          <?php if (!$booking): ?>
            <!-- NOT FOUND -->
            <div class="mc-booking-form-card text-center py-5">
              <i class="bi bi-search" style="font-size:3rem;color:var(--mc-red);opacity:0.4;"></i>
              <h4 class="mt-3 mb-2" style="font-family:'Playfair Display',serif;">Booking Not Found</h4>
              <p class="mc-body-text mb-4">
                <?php echo $client_id !== '' ? "No booking found for ID <strong>" . htmlspecialchars($client_id) . "</strong>." : "No booking ID was provided."; ?>
              </p>
              <a href="booking.php" class="btn mc-btn-primary px-4"><i class="bi bi-calendar2-plus me-2"></i>Make a Booking</a>
            </div>

          <?php else: ?>
            <!-- STATUS BANNER -->
            <div style="background:<?= $cfg['bg'] ?>;border:1.5px solid <?= $cfg['border'] ?>;border-radius:14px;padding:1.1rem 1.4rem;display:flex;align-items:center;gap:0.85rem;margin-bottom:1.5rem;">
              <i class="bi <?= $cfg['icon'] ?>" style="font-size:1.6rem;color:<?= $cfg['color'] ?>;flex-shrink:0;"></i>
              <div>
                <div style="font-weight:800;font-size:1rem;color:<?= $cfg['color'] ?>;"><?= $cfg['label'] ?></div>
                <div style="font-size:0.87rem;color:#374151;margin-top:0.2rem;line-height:1.55;"><?= $msg ?></div>
              </div>
            </div>

            <!-- RECEIPT CARD -->
            <div class="mc-booking-form-card">

              <!-- Client ID header -->
              <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:1.4rem;padding-bottom:1rem;border-bottom:1.5px solid #f0e8e6;">
                <div>
                  <div style="font-size:0.75rem;color:var(--mc-gray);font-weight:700;text-transform:uppercase;letter-spacing:0.07em;">Booking Reference</div>
                  <div style="font-size:1.35rem;font-weight:900;color:var(--mc-red);letter-spacing:0.06em;font-family:'Playfair Display',serif;"><?= htmlspecialchars($booking['client_id']) ?></div>
                </div>
                <span style="background:<?= $cfg['bg'] ?>;border:1.5px solid <?= $cfg['border'] ?>;color:<?= $cfg['color'] ?>;font-size:0.8rem;font-weight:700;padding:0.3rem 0.85rem;border-radius:20px;">
                  <i class="bi <?= $cfg['icon'] ?> me-1"></i><?= $cfg['label'] ?>
                </span>
              </div>

              <!-- Details grid -->
              <div class="row g-3">
                <?php
                $fields = [
                    ['bi-person-fill',    'Client Name',      htmlspecialchars($booking['client_name'])],
                    ['bi-tag-fill',       'Event Type',       htmlspecialchars($booking['event_type'])],
                    ['bi-calendar3',      'Event Date',       fmt_date($booking['event_date'])],
                    ['bi-clock-fill',     'Event Time',       fmt_time($booking['event_time'])],
                    ['bi-people-fill',    'Number of Guests', htmlspecialchars($booking['guest_count'])],
                    ['bi-box-seam-fill',  'Package',          htmlspecialchars($booking['package'])],
                    ['bi-geo-alt-fill',   'Venue',            htmlspecialchars($booking['venue'])],
                    ['bi-envelope-fill',  'Email',            htmlspecialchars($booking['email'] ?? '—')],
                    ['bi-telephone-fill', 'Phone',            htmlspecialchars($booking['phone'] ?? '—')],
                ];
                if (!empty($booking['duration'])) {
                    $fields[] = ['bi-stopwatch-fill', 'Duration', htmlspecialchars($booking['duration'])];
                }
                $parsed_sr = parse_sr($booking['special_requests'] ?? '');
                if (!empty($parsed_sr['addons'])) {
                    $fields[] = ['bi-plus-circle-fill', 'Add-Ons', implode(' &nbsp;·&nbsp; ', array_map('htmlspecialchars', $parsed_sr['addons']))];
                }
                if ($parsed_sr['requests'] !== '') {
                    $fields[] = ['bi-chat-left-text-fill', 'Special Requests', nl2br(htmlspecialchars($parsed_sr['requests']))];
                }
                foreach ($fields as [$icon, $label, $value]):
                ?>
                <div class="col-md-6">
                  <div style="background:var(--mc-off-white);border-radius:8px;padding:0.7rem 0.9rem;">
                    <div style="font-size:0.72rem;color:var(--mc-gray);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:0.2rem;">
                      <i class="bi <?= $icon ?> me-1" style="color:var(--mc-red);"></i><?= $label ?>
                    </div>
                    <div style="font-weight:600;font-size:0.92rem;color:#111827;"><?= $value ?></div>
                  </div>
                </div>
                <?php endforeach; ?>

                <?php if ($parsed_sr['food']): ?>
                <?php
                  $food_line = $parsed_sr['food'];
                  $food_prefix = ''; $food_dishes = '';
                  if (preg_match('/^(Party Tray \(\d+ Pax\)):\s*(.+)$/', $food_line, $m)) {
                      $food_prefix = $m[1]; $food_dishes = $m[2];
                  } elseif (str_starts_with($food_line, 'Food Order: ')) {
                      $food_dishes = substr($food_line, 12);
                  }
                  $dish_list = array_values(array_filter(array_map('trim', explode(', ', $food_dishes))));
                ?>
                <div class="col-12">
                  <div style="background:#fff8f8;border:1.5px solid var(--mc-red);border-radius:10px;padding:0.85rem 1rem;">
                    <div style="font-size:0.72rem;color:var(--mc-gray);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:0.6rem;">
                      <i class="bi bi-menu-button-wide-fill me-1" style="color:var(--mc-red);"></i>Selected Dishes
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:0.4rem;">
                      <?php if ($food_prefix): ?>
                        <span style="background:#fee2e2;border:1px solid #fca5a5;border-radius:14px;padding:0.2rem 0.75rem;font-size:0.82rem;font-weight:700;color:var(--mc-red);"><?= htmlspecialchars($food_prefix) ?></span>
                      <?php endif; ?>
                      <?php foreach ($dish_list as $dish): ?>
                        <span style="background:#fff;border:1.5px solid #fca5a5;border-radius:14px;padding:0.2rem 0.75rem;font-size:0.82rem;font-weight:600;color:#374151;"><?= htmlspecialchars($dish) ?></span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              </div>

              <!-- Footer note -->
              <div style="margin-top:1.4rem;padding-top:1rem;border-top:1.5px solid #f0e8e6;font-size:0.83rem;color:var(--mc-gray);line-height:1.7;">
                <i class="bi bi-info-circle-fill me-1" style="color:var(--mc-red);"></i>
                For questions or changes, contact us at <strong>0999 864 8368</strong> or <strong>mdavesulabo@yahoo.com</strong>.
              </div>
            </div>

            <!-- QR CODE CARD -->
            <div class="mc-booking-form-card text-center mt-4" style="padding:2rem 1.5rem;">
              <p class="mc-section-pre mb-1">Your Booking QR Code</p>
              <p class="mc-body-text mb-4" style="font-size:0.86rem;max-width:380px;margin-inline:auto;">
                Scan this QR code to access your booking receipt anytime.
              </p>

              <!-- Booking ID badge -->
              <div style="display:inline-block;background:var(--mc-off-white);border:1.5px solid #e5d5d2;border-radius:10px;padding:0.55rem 1.4rem;margin-bottom:1.4rem;">
                <div style="font-size:0.7rem;color:var(--mc-gray);font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.2rem;">Booking Reference</div>
                <div style="font-size:1.5rem;font-weight:900;color:var(--mc-red);letter-spacing:0.07em;font-family:'Playfair Display',serif;">
                  <?= htmlspecialchars($booking['client_id']) ?>
                </div>
              </div>

              <!-- QR code (generated by JS — instant, no external API) -->
              <div style="display:inline-block;border:4px solid #f0e8e6;border-radius:12px;padding:8px;background:#fff;margin-bottom:1.2rem;">
                <div id="mc-qr-wrap" style="border-radius:6px;overflow:hidden;"></div>
              </div>

              <!-- Download button -->
              <div>
                <button onclick="downloadQR()" class="btn mc-btn-primary px-4">
                  <i class="bi bi-download me-2"></i>Download QR Code
                </button>
              </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-4">
              <a href="index.php" class="btn mc-btn-outline-red me-2"><i class="bi bi-house-fill me-1"></i>Go to Homepage</a>
              <a href="contact.php" class="btn mc-btn-primary"><i class="bi bi-chat-fill me-1"></i>Contact Us</a>
            </div>

          <?php endif; ?>

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
      <p class="text-center text-white-50 small mb-0">&copy; 2026 Medy's Catering. All rights reserved. | Developed for Academic Research &ndash; PUP</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
  <script src="assets/script.js"></script>
  <?php if ($booking && $receipt_url): ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script>
    var MC_RECEIPT_URL = <?= json_encode($receipt_url) ?>;
    var MC_CLIENT_ID   = <?= json_encode($booking['client_id']) ?>;

    new QRCode(document.getElementById('mc-qr-wrap'), {
      text: MC_RECEIPT_URL,
      width: 220,
      height: 220,
      colorDark: '#1a1a1a',
      colorLight: '#ffffff',
      correctLevel: QRCode.CorrectLevel.H
    });

    function downloadQR() {
      var img = document.querySelector('#mc-qr-wrap img');
      if (!img) return;
      var a = document.createElement('a');
      a.download = 'medys-booking-' + MC_CLIENT_ID + '.png';
      a.href = img.src;
      a.click();
    }
  </script>
  <?php endif; ?>
</body>
</html>
