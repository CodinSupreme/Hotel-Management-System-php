<?php
// about.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us — Haven Hub Hotels</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar" id="navbar">
    <div class="logo">
      <a href="home.php">
        <img src="images/logo.png" alt="Haven Hub Hotels">
      </a>
    </div>
    <ul class="nav-links">
      <li><a href="home.php">Home</a></li>
      <li><a href="accommodations.php">Accommodations</a></li>
      <li><a href="dining.php">Dining</a></li>
      <li><a href="about.php" class="active">About Us</a></li>
      <li><a href="home.php#contact">Contact</a></li>
      <li><a href="forms.php" class="btn btn-primary">Book Now</a></li>
    </ul>
  </nav>

  <section class="section">
    <div class="container">
      <div class="about-content">
        <h2>Our Story</h2>
        <p>
          Founded with a vision to redefine urban hospitality, <strong>Haven Hub Hotels</strong> was born from a simple belief: every guest deserves a sanctuary that blends comfort, style, and genuine care.
        </p>
        <p>
          Nestled in the heart of the city, our property is more than just a place to stay — it’s a thoughtfully curated experience designed for travelers who value authenticity, attention to detail, and seamless service.
        </p>

        <div class="values-grid">
          <?php
          $values = [
            [
              'icon' => 'fa-solid fa-hand-holding-heart',
              'title' => 'Guest-Centric Care',
              'desc' => 'We listen, anticipate, and respond with warmth and professionalism — because your comfort is our priority.'
            ],
            [
              'icon' => 'fa-solid fa-leaf',
              'title' => 'Sustainable Luxury',
              'desc' => 'We integrate eco-conscious practices without compromising on elegance — from locally sourced meals to energy-efficient spaces.'
            ],
            [
              'icon' => 'fa-solid fa-shield-halved',
              'title' => 'Trust & Transparency',
              'desc' => 'Honest pricing, secure booking, and clear communication — because trust is the foundation of every great stay.'
            ]
          ];

          foreach ($values as $value) {
            echo "
            <div class='value-card'>
              <i class='{$value['icon']} icon-large'></i>
              <h3>{$value['title']}</h3>
              <p>{$value['desc']}</p>
            </div>
            ";
          }
          ?>
        </div>

        <h2 style="margin-top: 4rem;">Our Promise</h2>
        <p>
          At Haven Hub, we don’t just offer rooms and meals — we craft moments. Whether you’re here for business, leisure, or a quiet retreat, our team is committed to making your stay effortless, memorable, and uniquely yours.
        </p>
        <p>
          From the moment you book to the time you check out, expect thoughtful touches, responsive service, and a space that feels like your own.
        </p>

        <div class="cta-section" style="text-align: center; margin-top: 3rem;">
          <a href="accomodation.php" class="btn btn-primary">Explore Our Rooms</a>
          <a href="dining.php" class="btn btn-primary" style="margin-left: 1rem;">Discover Our Menu</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Reusable Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="accomodation.php">Rooms &amp; Suites</a></li>
            <li><a href="dining.php">Dining</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="home.php#contact">Contact</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4>Connect With Us</h4>
          <div class="social-links">
            <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://whatsapp.com" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://tiktok.com" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://linkedin.com" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2025<br>Haven Hub Hotels.<br>All rights reserved.</p>
      </div>
    </div>
  </footer>
</body>
</html>
