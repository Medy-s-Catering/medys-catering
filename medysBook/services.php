<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services – Medy's Catering</title>
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
          <li class="nav-item"><a class="nav-link active" href="services.php">Services</a></li>
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
        <a href="index.php">Home</a> / <span>Services</span>
      </nav>
      <h1 class="animate-fade-up">Our <span style="color:var(--mc-gold)">Services</span></h1>
      <p class="animate-fade-up delay-1 mt-2">Comprehensive catering and event management solutions for every occasion</p>
    </div>
  </section>

  <section class="py-5 mc-section">
    <div class="container">
      <div class="row align-items-center g-5 mb-5 pb-4 border-bottom">
        <div class="col-lg-5"><div class="mc-img-frame"><img src="https://images.pexels.com/photos/18749086/pexels-photo-18749086.jpeg?auto=compress&cs=tinysrgb&w=700" alt="Corporate catering buffet" class="img-fluid rounded-3 shadow" /></div></div>
        <div class="col-lg-7">
          <div class="mc-service-icon mb-3"><i class="bi bi-building"></i></div>
          <h3 class="mc-section-title">Corporate <span class="mc-accent">Events</span></h3>
          <p class="mc-body-text">We provide full catering and event management support for corporate gatherings — seminars, team building activities, company anniversaries, product launches, and more.</p>
          <ul class="mc-body-text ps-3"><li>Conference & seminar catering</li><li>Product launch events</li><li>Team building activities</li><li>Company anniversary parties</li><li>Business luncheons and dinners</li></ul>
          <a href="booking.php" class="btn mc-btn-primary mt-2">Book This Service</a>
        </div>
      </div>

      <div class="row align-items-center g-5 mb-5 pb-4 border-bottom flex-lg-row-reverse">
        <div class="col-lg-5"><div class="mc-img-frame"><img src="https://images.pexels.com/photos/32644053/pexels-photo-32644053.jpeg?auto=compress&cs=tinysrgb&w=700" alt="Wedding catering table with dishes" class="img-fluid rounded-3 shadow" /></div></div>
        <div class="col-lg-7">
          <div class="mc-service-icon mb-3"><i class="bi bi-heart"></i></div>
          <h3 class="mc-section-title">Weddings & <span class="mc-accent">Receptions</span></h3>
          <p class="mc-body-text">Your wedding day deserves nothing less than perfection. Medy's Catering handles the food, venue setup, and coordination so you can focus on celebrating your love.</p>
          <ul class="mc-body-text ps-3"><li>Elegant buffet and plated meal setups</li><li>Custom wedding menu planning</li><li>Venue decoration and table arrangements</li><li>Wedding reception coordination</li><li>Dessert stations and wedding cakes</li></ul>
          <a href="booking.php" class="btn mc-btn-primary mt-2">Book This Service</a>
        </div>
      </div>

      <div class="row align-items-center g-5 mb-5 pb-4 border-bottom">
        <div class="col-lg-5"><div class="mc-img-frame"><img src="https://images.pexels.com/photos/31972322/pexels-photo-31972322.jpeg?auto=compress&cs=tinysrgb&w=700" alt="Birthday party catering table" class="img-fluid rounded-3 shadow" /></div></div>
        <div class="col-lg-7">
          <div class="mc-service-icon mb-3"><i class="bi bi-balloon-heart"></i></div>
          <h3 class="mc-section-title">Birthdays & <span class="mc-accent">Socials</span></h3>
          <p class="mc-body-text">Celebrate life's milestones with Medy's Catering. Whether it's a debut, a sweet sixteen, or a golden anniversary, we bring color, flavor, and joy to every celebration.</p>
          <ul class="mc-body-text ps-3"><li>Birthday party packages</li><li>Debut and milestone celebrations</li><li>Family reunions and gatherings</li><li>Themed party setups</li><li>Customized menus for all ages</li></ul>
          <a href="booking.php" class="btn mc-btn-primary mt-2">Book This Service</a>
        </div>
      </div>

      <div class="row align-items-center g-5 mb-5 pb-4 border-bottom flex-lg-row-reverse">
        <div class="col-lg-5"><div class="mc-img-frame"><img src="https://images.pexels.com/photos/35247187/pexels-photo-35247187.jpeg?auto=compress&cs=tinysrgb&w=700" alt="School event catering buffet" class="img-fluid rounded-3 shadow" /></div></div>
        <div class="col-lg-7">
          <div class="mc-service-icon mb-3"><i class="bi bi-mortarboard"></i></div>
          <h3 class="mc-section-title">School <span class="mc-accent">Activities</span></h3>
          <p class="mc-body-text">From graduation ceremonies to school fairs, Medy's Catering provides dependable, budget-friendly catering solutions for educational institutions.</p>
          <ul class="mc-body-text ps-3"><li>Graduation ceremonies and receptions</li><li>School fairs and bazaars</li><li>Faculty and staff gatherings</li><li>Sports day refreshments</li><li>Recognition and awards events</li></ul>
          <a href="booking.php" class="btn mc-btn-primary mt-2">Book This Service</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ── FULL MENU ─────────────────────────────────────────────────────────── -->
  <section class="py-5 mc-section-alt" id="menu">
    <div class="container">
      <div class="text-center mb-5">
        <p class="mc-section-pre">Our Cuisine</p>
        <h2 class="mc-section-title">Full <span class="mc-accent">Menu</span></h2>
        <p class="mc-body-text mx-auto" style="max-width:520px;">Choose from our wide selection for your event. Custom menus are always available upon request.</p>
      </div>

      <!-- Menu category tabs -->
      <div class="d-flex justify-content-center flex-wrap gap-2 mb-4" id="menuTabs">
        <button class="btn mc-btn-primary btn-sm" data-cat="all">All</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="beef">Beef</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="pork">Pork</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="chicken">Chicken</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="seafood">Fish & Seafood</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="veggies">Vegetables</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="pasta">Pasta & Noodles</button>
        <button class="btn mc-btn-outline-red btn-sm" data-cat="dessert">Dessert</button>
      </div>

      <div class="row g-4" id="menuGrid">

        <div class="col-md-6 col-lg-3 menu-col" data-cat="beef">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Beef</h5>
            <?php foreach(['Grilled Korean Beef','Pastel de Lengua','Lengua Sevillana','Lengua Estofado / Estofada','Roast Beef w/ Mushroom Sauce','Beef with Mushroom Sauce','Beef Stroganoff','Beef Kare-Kare','Beef w/ Broccoli','Beef Steak Tagalog','Beef Ampalaya','Beef Salpicao','Beef Morcon','Beef Kaldereta','Braised Beef'] as $item): ?>
            <div class="mc-menu-item"><span><?= $item ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 menu-col" data-cat="pork">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Pork</h5>
            <?php foreach(['Sweet and Spicy Ribs','Spicy Korean BBQ','Pork Stroganoff','Pork Chili Garlic','Pork Kaldereta','Pork Binagoongan','Pork Morcon','Pork Adobo','Pork Steak','Pata Kare-Kare','Roast Pork w/ Mushroom Sauce','Braised Pork','Chinese Asado','Pork Hamonado','Pork w/ Broccoli','Asadong Tagalog','Pork w/ Peas and Quail Eggs','Tokwa\'t Baboy','Lechon Kawali','Crispy Pata','Pork Sisig'] as $item): ?>
            <div class="mc-menu-item"><span><?= htmlspecialchars($item) ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 menu-col" data-cat="chicken">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Chicken</h5>
            <?php foreach(['Korean Chicken','Chicken Cordon Bleu','Chicken Pastel','Chicken Teriyaki','Chicken Oriental','Lemon Chicken','Garlic Chicken','Chicken w/ Peas and Quail Eggs','Chicken Flambe','Garlic Parmesan Chicken','Buffalo Wing','Honey Garlic Chicken','Hawaiian Chicken'] as $item): ?>
            <div class="mc-menu-item"><span><?= $item ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 menu-col" data-cat="seafood">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Fish & Seafoods</h5>
            <?php foreach(['Fish Fillet (w/ Sauce)','Grilled Tanigue in Lemon Butter Sauce','Baked Pink Salmon','Relyenong Hipon','Shrimp Tempura','Buttered Shrimp'] as $item): ?>
            <div class="mc-menu-item"><span><?= $item ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 menu-col" data-cat="veggies">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Vegetables</h5>
            <?php foreach(['Chopsuey','Mixed Vegetables w/ Seafood','Shrimp w/ Broccoli','Buttered Carrot and Corn','Fresh Lumpia','Fresh Lumpia Hubad','Buttered Vegetables','Sepo Egg'] as $item): ?>
            <div class="mc-menu-item"><span><?= $item ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 menu-col" data-cat="pasta">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Pasta & Noodles</h5>
            <?php foreach(['Special Pansit Canton w/ Sotanghon','Palabok','Spaghetti','Carbonara','Tuna Pasta','Baked Macaroni','Baked Lasagna','Korean Noodles'] as $item): ?>
            <div class="mc-menu-item"><span><?= $item ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 menu-col" data-cat="dessert">
          <div class="mc-services-detail h-100">
            <h5 class="mc-service-title mb-3"><i class="bi bi-bookmark-fill mc-accent me-2"></i>Dessert</h5>
            <?php foreach(['Buko Pandan','Fruit Salad w/ Cream','Potato Salad','Macaroni Salad','Mango Sago w/ Jelly','Leche Flan','Buko Salad','Panna Cotta','Ube','Macapuno'] as $item): ?>
            <div class="mc-menu-item"><span><?= $item ?></span></div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ── PACKAGES ───────────────────────────────────────────────────────────── -->
  <section class="py-5 mc-section" id="packages">
    <div class="container">
      <div class="text-center mb-5">
        <p class="mc-section-pre">Pricing</p>
        <h2 class="mc-section-title">Service <span class="mc-accent">Packages</span></h2>
        <p class="mc-body-text mx-auto" style="max-width:520px;">All prices are per plate. Packages can be customized to suit your event needs.</p>
      </div>
      <div class="row g-4 align-items-stretch">

        <!-- Package A -->
        <div class="col-md-4">
          <div class="mc-service-card h-100 d-flex flex-column">
            <div class="text-center mb-3">
              <span class="mc-section-pre">Package A</span>
              <div class="display-5 fw-bold mc-accent">₱550 <small class="fs-6 fw-normal" style="color:var(--mc-gray);">/plate</small></div>
            </div>
            <hr />
            <p class="fw-bold mc-body-text small mb-1" style="color:var(--mc-red);">Food Inclusions</p>
            <?php foreach(['Pork','Beef','Chicken / Fish','Pasta / Noodles / Veggies','Rice','1 Dessert','Drinks (Iced Tea, Cucumber Lemonade, Lemonade)','Water & Ice'] as $i): ?>
            <div class="mc-menu-item"><i class="bi bi-check2 mc-accent me-1"></i><span><?= $i ?></span></div>
            <?php endforeach; ?>
            <p class="fw-bold mc-body-text small mb-1 mt-3" style="color:var(--mc-red);">Catering Inclusions</p>
            <?php foreach(['Complete Catering Equipment','Plates, Hi Ball Glass, Utensils','Buffet Setup','Basic Balloon Decor / Flower','Table Centerpiece','Uniformed Waiters & Waitresses'] as $i): ?>
            <div class="mc-menu-item"><i class="bi bi-check2 mc-accent me-1"></i><span><?= $i ?></span></div>
            <?php endforeach; ?>
            <a href="booking.php" class="btn mc-btn-outline-red w-100 mt-auto pt-3">Book Package A</a>
          </div>
        </div>

        <!-- Package B -->
        <div class="col-md-4">
          <div class="mc-service-card h-100 d-flex flex-column" style="border-color:var(--mc-red);border-width:2px;">
            <div class="text-center mb-3">
              <span class="badge bg-danger mb-1">Most Popular</span><br>
              <span class="mc-section-pre">Package B</span>
              <div class="display-5 fw-bold mc-accent">₱600 <small class="fs-6 fw-normal" style="color:var(--mc-gray);">/plate</small></div>
            </div>
            <hr />
            <p class="fw-bold mc-body-text small mb-1" style="color:var(--mc-red);">Food Inclusions</p>
            <?php foreach(['Pork','Beef','Chicken / Fish','Pasta / Noodles','Veggies','Rice','1 Dessert','Drinks (Iced Tea, Cucumber Lemonade, Lemonade)','Water & Ice'] as $i): ?>
            <div class="mc-menu-item"><i class="bi bi-check2 mc-accent me-1"></i><span><?= $i ?></span></div>
            <?php endforeach; ?>
            <p class="fw-bold mc-body-text small mb-1 mt-3" style="color:var(--mc-red);">Catering Inclusions</p>
            <?php foreach(['Complete Catering Equipment','Plates, Hi Ball Glass, Utensils, Water Goblet, Table Napkin','Buffet Setup','Balloon Decor / Flower Decor','Table Centerpiece','Stage Decoration','Name Cut Outs (Styro)','Uniformed Waiters & Waitresses','Celebrant\'s Bench / Couch'] as $i): ?>
            <div class="mc-menu-item"><i class="bi bi-check2 mc-accent me-1"></i><span><?= htmlspecialchars($i) ?></span></div>
            <?php endforeach; ?>
            <a href="booking.php" class="btn mc-btn-primary w-100 mt-auto pt-3">Book Package B</a>
          </div>
        </div>

        <!-- Package C -->
        <div class="col-md-4">
          <div class="mc-service-card h-100 d-flex flex-column">
            <div class="text-center mb-3">
              <span class="mc-section-pre">Package C</span>
              <div class="display-5 fw-bold mc-accent">₱700 <small class="fs-6 fw-normal" style="color:var(--mc-gray);">/plate</small></div>
            </div>
            <hr />
            <p class="fw-bold mc-body-text small mb-1" style="color:var(--mc-red);">Food Inclusions</p>
            <?php foreach(['Pork','Beef','Fish','Chicken','Pasta / Noodles','Veggies','Rice','2 Desserts','Drinks (Iced Tea, Cucumber Lemonade, Lemonade)','Water & Ice'] as $i): ?>
            <div class="mc-menu-item"><i class="bi bi-check2 mc-accent me-1"></i><span><?= $i ?></span></div>
            <?php endforeach; ?>
            <p class="fw-bold mc-body-text small mb-1 mt-3" style="color:var(--mc-red);">Full Catering Service</p>
            <?php foreach(['Complete Catering Equipment','Plates, Hi Ball Glass, Utensils, Water Goblet, Table Napkin','Theme Stage Decor','Green Carpet','Celebrant\'s Bench / Couch','Styro Name Backdrop','Table Centerpiece','Buffet Setup','Kiddie Table Setup','Balloon Decor / Flower Decor','Entrance Decoration','Uniformed Waiters & Waitresses'] as $i): ?>
            <div class="mc-menu-item"><i class="bi bi-check2 mc-accent me-1"></i><span><?= htmlspecialchars($i) ?></span></div>
            <?php endforeach; ?>
            <a href="booking.php" class="btn mc-btn-outline-red w-100 mt-auto pt-3">Book Package C</a>
          </div>
        </div>

      </div>
      <div class="alert mt-4 mb-0" style="background:var(--mc-off-white);border-left:4px solid var(--mc-red);border-radius:8px;font-size:0.87rem;color:var(--mc-gray);">
        <i class="bi bi-info-circle-fill mc-accent me-2"></i>
        <strong>Note:</strong> Price may vary depending on client demands. Booking fewer than 100 guests incurs an additional <strong>₱3,000.00</strong> service charge.
      </div>
    </div>
  </section>

  <!-- ── ADD-ONS ────────────────────────────────────────────────────────────── -->
  <section class="py-5 mc-section-alt" id="addons">
    <div class="container">
      <div class="text-center mb-5">
        <p class="mc-section-pre">Extras</p>
        <h2 class="mc-section-title">Available <span class="mc-accent">Add-Ons</span></h2>
        <p class="mc-body-text mx-auto" style="max-width:480px;">Enhance your event with any of our optional extras. Pricing on request.</p>
      </div>
      <div class="row g-3 justify-content-center">
        <?php foreach(['Ceiling Treatment','Tiffany Chair','Grazing Table','Photo & Video Coverage','Photo Booth','Assorted Kakanin Buffet','Coffee Station','Cake','Host / Emcee','On-the-Day Coordinator','Lights and Sounds','LED Wall'] as $addon): ?>
        <div class="col-6 col-md-4 col-lg-3">
          <div style="background:#fff;border:1.5px solid #ecdad8;border-left:4px solid var(--mc-red);border-radius:8px;padding:0.75rem 1rem;font-size:0.88rem;font-weight:600;color:#374151;">
            <i class="bi bi-plus-circle mc-accent me-2"></i><?= $addon ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ── KIDS MEAL ──────────────────────────────────────────────────────────── -->
  <section class="py-5 mc-section" id="kids">
    <div class="container">
      <div class="text-center mb-5">
        <p class="mc-section-pre">For the Little Ones</p>
        <h2 class="mc-section-title">Kids <span class="mc-accent">Meal</span></h2>
        <div class="d-inline-block mt-1 mb-3 px-4 py-2 fw-bold" style="background:var(--mc-red);color:#fff;border-radius:20px;font-size:1rem;">₱150 per plate</div>
      </div>
      <div class="row g-3 justify-content-center">
        <?php foreach(['Fried Chicken + Spaghetti','Fish Fillet + Spaghetti','Chicken Lollipop + Spaghetti','Baked Macaroni + Pork BBQ'] as $meal): ?>
        <div class="col-sm-6 col-md-3">
          <div class="mc-service-card text-center py-4 h-100">
            <i class="bi bi-egg-fried mc-accent mb-2" style="font-size:1.6rem;display:block;"></i>
            <div style="font-weight:700;font-size:0.92rem;color:#374151;"><?= $meal ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ── PARTY TRAYS ────────────────────────────────────────────────────────── -->
  <section class="py-5 mc-section-alt" id="trays">
    <div class="container">
      <div class="text-center mb-5">
        <p class="mc-section-pre">Take-Home Options</p>
        <h2 class="mc-section-title">Party <span class="mc-accent">Trays</span></h2>
        <p class="mc-body-text mx-auto" style="max-width:480px;">Order by the tray for your gathering. All prices are per tray.</p>
      </div>

      <!-- Tray tabs -->
      <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap" id="trayTabs">
        <button class="btn mc-btn-primary" data-tray="20">20 Pax</button>
        <button class="btn mc-btn-outline-red" data-tray="30">30 Pax</button>
        <button class="btn mc-btn-outline-red" data-tray="50">50 Pax</button>
      </div>

      <?php
      $trays = [
        '20' => [
          'Pork'           => '₱1,300 – ₱1,500',
          'Beef'           => '₱1,400 – ₱1,600',
          'Chicken'        => '₱900 – ₱1,300',
          'Fish / Seafood' => '₱900 – ₱2,400',
          'Pasta / Noodles'=> '₱800 – ₱1,200',
          'Vegetables'     => '₱900 – ₱1,200',
        ],
        '30' => [
          'Pork'           => '₱1,800 – ₱2,100',
          'Beef'           => '₱2,000 – ₱2,400',
          'Chicken'        => '₱1,350 – ₱1,950',
          'Fish / Seafood' => '₱1,300 – ₱3,600',
          'Pasta / Noodles'=> '₱1,000 – ₱1,500',
          'Vegetables'     => '₱1,350 – ₱1,800',
        ],
        '50' => [
          'Pork'           => '₱3,000 – ₱3,500',
          'Beef'           => '₱3,250 – ₱3,750',
          'Chicken'        => '₱2,250 – ₱3,250',
          'Fish / Seafood' => '₱2,250 – ₱6,000',
          'Pasta / Noodles'=> '₱2,400 – ₱3,000',
          'Vegetables'     => '₱2,250 – ₱3,000',
        ],
      ];
      $desserts = [
        'Leche Flan' => '₱90/pc', 'Panna Cotta' => '₱40/pc',
        'Buko Salad' => '₱1,000/jar', 'Buko Pandan' => '₱1,000/jar',
        'Mango Sago' => '₱1,000/jar', 'Fruit Salad' => '₱1,000/jar',
        'Macaroni Salad' => '₱1,000/jar', 'Potato Salad' => '₱1,000/jar',
      ];
      foreach ($trays as $pax => $items): ?>
      <div class="tray-panel" data-tray="<?= $pax ?>" <?= $pax !== '20' ? 'style="display:none;"' : '' ?>>
        <div class="row g-3">
          <?php foreach ($items as $cat => $price): ?>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="mc-service-card text-center py-3 h-100">
              <div class="mc-body-text small fw-bold mb-1"><?= $cat ?></div>
              <div class="fw-bold" style="color:var(--mc-red);font-size:0.88rem;"><?= $price ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="mc-services-detail mt-4">
          <h6 class="mc-service-title mb-3"><i class="bi bi-cup-hot mc-accent me-2"></i>Desserts (all tray sizes)</h6>
          <div class="row g-2">
            <?php foreach ($desserts as $name => $dprice): ?>
            <div class="col-6 col-md-3">
              <div class="mc-menu-item justify-content-between"><span><?= $name ?></span><strong class="mc-accent"><?= $dprice ?></strong></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="alert mt-4 mb-0" style="background:var(--mc-off-white);border-left:4px solid var(--mc-red);border-radius:8px;font-size:0.87rem;color:var(--mc-gray);">
        <i class="bi bi-info-circle-fill mc-accent me-2"></i>
        <strong>Note:</strong> Party tray prices are subject to change without prior notice.
      </div>
    </div>
  </section>

  <script>
    // Menu category filter
    document.querySelectorAll('#menuTabs button').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('#menuTabs button').forEach(b => {
          b.classList.remove('mc-btn-primary');
          b.classList.add('mc-btn-outline-red');
        });
        this.classList.remove('mc-btn-outline-red');
        this.classList.add('mc-btn-primary');
        const cat = this.dataset.cat;
        document.querySelectorAll('#menuGrid .menu-col').forEach(col => {
          col.style.display = (cat === 'all' || col.dataset.cat === cat) ? '' : 'none';
        });
      });
    });

    // Party tray tabs
    document.querySelectorAll('#trayTabs button').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('#trayTabs button').forEach(b => {
          b.classList.remove('mc-btn-primary');
          b.classList.add('mc-btn-outline-red');
        });
        this.classList.remove('mc-btn-outline-red');
        this.classList.add('mc-btn-primary');
        const pax = this.dataset.tray;
        document.querySelectorAll('.tray-panel').forEach(p => {
          p.style.display = p.dataset.tray === pax ? '' : 'none';
        });
      });
    });
  </script>

  <section class="py-5 mc-cta text-center">
    <div class="container">
      <h2 class="mc-section-title">Have a <span class="mc-accent">Custom Request?</span></h2>
      <p class="mc-body-text mx-auto mb-4" style="max-width:500px;">Every event is unique. Contact us to discuss your specific needs and get a customized quote.</p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="booking.php" class="btn mc-btn-primary btn-lg px-5">Book Now</a>
        <a href="contact.php" class="btn mc-btn-outline-red btn-lg px-5">Get a Quote</a>
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
</body>
</html>
