<?php
// Start session for user login
session_start();

// Include database and functions
include 'database_connection.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Haven Hub Hotels</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar" id="navbar">
    <div class="logo">
      <a href="index.php">
        <img src="images/logo.png" alt="Haven Hub Hotels">
      </a>
    </div>

    <div class="menu-toggle" id="menu-toggle">
      <i class="fa-solid fa-bars"></i>
    </div>

    <ul class="nav-links" id="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="accomodation.php">Accommodation</a></li>
      <li><a href="dining.php">Dining</a></li>
      <li><a href="about.php">About us</a></li>
      <li><a href="#contact">Contact</a></li>
      <li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="dashboard.php" class="btn btn-secondary">My Account</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-primary">Book Now</a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <header class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>Experience Luxury at Its Finest</h1>
      <p>Where comfort meets elegance in the heart of the city</p>
      <a href="accomodation.php" class="btn btn-primary">Book Your Stay</a>
    </div>
  </header>

  <!-- Rooms from Database -->
  <section id="rooms" class="section">
    <div class="container">
      <h2>Our Accommodations</h2>
      <div class="card-grid">
        <?php
        // Get rooms from database
        $rooms = getAllRooms();
        
        // Display each room
        foreach ($rooms as $room) {
            echo '
            <div class="card">
              <div class="card-image" style="background-image:url(\'images/room1.jpg\')"></div>
              <div class="card-content">
                <h3>' . $room['room_type'] . '</h3>
                <p>' . $room['bed_type'] . ' Bed</p>
                <p class="price">$' . $room['price_per_night'] . '/night</p>
                <a href="book.php?room_id=' . $room['room_id'] . '" class="btn btn-primary">Book Now</a>
              </div>
            </div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Services from Database -->
  <section id="services" class="section bg-light">
    <div class="container">
      <h2>Our Services</h2>
      <div class="card-grid">
        <?php
        // Get services from database
        $services = getAllServices();
        
        // Display each service
        foreach ($services as $service) {
            echo '
            <div class="card">
              <div class="card-content">
                <h3>' . $service['service_name'] . '</h3>
                <p>' . $service['service_description'] . '</p>
                <p class="price">$' . $service['service_price'] . '</p>
              </div>
            </div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Rest of your existing HTML -->
  <section id="amenities" class="section">
    <div class="container">
      <h2>Hotel Amenities</h2>
      <div class="card-grid">
        <div class="card amenity-card"><i class="fa-solid fa-person-swimming icon-large"></i><h3>Swimming Pool</h3><p>Infinity pool with city views</p></div>
        <div class="card amenity-card"><i class="fa-solid fa-utensils icon-large"></i><h3>Fine Dining</h3><p>Award-winning restaurants</p></div>
        <div class="card amenity-card"><i class="fa-solid fa-spa icon-large"></i><h3>Luxury Spa</h3><p>Full-service wellness center</p></div>
        <div class="card amenity-card"><i class="fa-solid fa-dumbbell icon-large"></i><h3>Fitness Center</h3><p>24/7 state-of-the-art gym</p></div>
        <div class="card amenity-card"><i class="fa-solid fa-wifi icon-large"></i><h3>High-Speed Wi-Fi</h3><p>Complimentary ultra-fast internet</p></div>
        <div class="card amenity-card"><i class="fa-solid fa-concierge-bell icon-large"></i><h3>24/7 Concierge</h3><p>Personalized service anytime</p></div>
      </div>
    </div>
  </section>

  <section id="contact" class="section">
    <div class="container">
      <h2>Contact Us</h2>
      <div class="contact-container">
        <div class="contact-info">
          <h3>Haven Hub Hotels</h3>
          <p><i class="fa-solid fa-location-dot"></i> 123 Luxury Avenue, Nairobi</p>
          <p><i class="fa-solid fa-phone"></i> +254 765 325 412</p>
          <p><i class="fa-solid fa-envelope"></i> info@havenhub.com</p>
        </div>
        <form class="contact-form" action="contact.php" method="POST">
          <input type="text" name="name" placeholder="Your Name" required />
          <input type="email" name="email" placeholder="Your Email" required />
          <textarea name="message" placeholder="Your Message" required></textarea>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="accomodation.php">Rooms & Suites</a></li>
            <li><a href="dining.php">Dining</a></li>
            <li><a href="about.php">Amenities</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4>Connect With Us</h4>
          <div class="social-links">
            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            <a href="#"><i class="fa-brands fa-telegram"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>
      </div>
      <hr />
      <div class="footer-bottom">
        <p>© 2025 Haven Hub Hotels. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="main.js"></script>
</body>
</html>