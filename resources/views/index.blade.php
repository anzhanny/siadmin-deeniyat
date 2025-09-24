<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page Argon</title>
  <!-- Argon CSS -->
  <link href="https://cdn.jsdelivr.net/npm/@creative-tim-official/argon-design-system-free@1.2.2/assets/css/argon-design-system.min.css" rel="stylesheet">
  <!-- Optional: Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="#">MyLanding</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="section section-lg section-shaped pb-250">
    <div class="shape shape-style-1 shape-default">
      <span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span>
    </div>
    <div class="container py-lg-md d-flex">
      <div class="col px-0">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="display-3 text-white">Welcome to MyLanding<br></h1>
            <p class="lead text-white">Simple and elegant landing page built with Argon Design System.</p>
            <div class="btn-wrapper">
              <a href="#contact" class="btn btn-info btn-lg">Get Started</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew">
      <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="section section-lg">
    <div class="container">
      <div class="row justify-content-center text-center mb-lg">
        <div class="col-lg-8">
          <h2 class="display-3">Our Features</h2>
          <p class="lead">Here are some amazing features that make our product stand out.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="info">
            <div class="icon icon-shape bg-gradient-info shadow rounded-circle mb-4">
              <i class="fas fa-rocket text-white"></i>
            </div>
            <h5 class="info-title">Fast Performance</h5>
            <p>Optimized for speed and performance so you can work efficiently.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info">
            <div class="icon icon-shape bg-gradient-success shadow rounded-circle mb-4">
              <i class="fas fa-lock text-white"></i>
            </div>
            <h5 class="info-title">Secure</h5>
            <p>Security is our top priority, keeping your data safe and protected.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info">
            <div class="icon icon-shape bg-gradient-warning shadow rounded-circle mb-4">
              <i class="fas fa-mobile-alt text-white"></i>
            </div>
            <h5 class="info-title">Responsive</h5>
            <p>Looks great on any device, whether desktop, tablet, or mobile.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="section bg-secondary">
    <div class="container">
      <div class="row justify-content-center text-center mb-lg">
        <div class="col-lg-8">
          <h2 class="display-3">About Us</h2>
          <p class="lead">We are dedicated to creating elegant and functional web interfaces for everyone.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="section section-lg">
    <div class="container">
      <div class="row justify-content-center text-center mb-lg">
        <div class="col-lg-8">
          <h2 class="display-3">Contact Us</h2>
          <p class="lead">Have questions? Reach out to us and we'll respond promptly.</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <form>
            <div class="form-group mb-3">
              <input type="text" class="form-control" placeholder="Your Name">
            </div>
            <div class="form-group mb-3">
              <input type="email" class="form-control" placeholder="Email Address">
            </div>
            <div class="form-group mb-3">
              <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container text-center">
      <p class="mb-0">&copy; 2025 MyLanding. All rights reserved.</p>
    </div>
  </footer>

  <!-- Argon JS -->
  <script src="https://cdn.jsdelivr.net/npm/@creative-tim-official/argon-design-system-free@1.2.2/assets/js/argon-design-system.min.js"></script>
</body>
</html>
