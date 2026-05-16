<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HMS - Hospital Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
  <div class="logo">HMS</div>
  <ul class="nav-links">
    <li><a href="#home">Home</a></li>
    <li><a href="#services">Services</a></li>
    <li><a href="#about">About Us</a></li>
    <li><a href="#gallery">Gallery</a></li>
    <li><a href="#contact">Contact Us</a></li>
    <li><a href="#logins">Logins</a></li>
  </ul>
  <a href="#contact" class="btn-primary">Book an Appointment</a>
</nav>

<!-- HERO -->
<section id="home" style="padding:0; position:relative;">
  <img src="Hospital-management-system-1.png" alt="">
</section>

<!-- LOGINS -->
<section id="logins" class="logins">
  <h2 class="section-title">Logins</h2>
  <div class="login-cards">

    <div class="login-card">
      <div class="login-card-img">
        <svg viewBox="0 0 240 140" xmlns="http://www.w3.org/2000/svg">
          <rect width="240" height="140" fill="#cdf2eb"/>
          <!-- Patient illustration -->
          <circle cx="120" cy="48" r="28" fill="#7cd5c5"/>
          <ellipse cx="120" cy="110" rx="38" ry="26" fill="#5cbdac"/>
          <rect x="108" y="36" width="24" height="8" rx="3" fill="white" opacity="0.6"/>
          <rect x="116" y="28" width="8" height="24" rx="3" fill="white" opacity="0.6"/>
          <line x1="60" y1="90" x2="80" y2="90" stroke="white" stroke-width="2" opacity="0.5"/>
          <line x1="160" y1="90" x2="180" y2="90" stroke="white" stroke-width="2" opacity="0.5"/>
        </svg>
      </div>
      <div class="login-card-body">
        <h3>Patient Login</h3>
        <a href="patient-reg.php" class="btn-sm">Click Here</a>
      </div>
    </div>

    <div class="login-card">
      <div class="login-card-img">
        <svg viewBox="0 0 240 140" xmlns="http://www.w3.org/2000/svg">
          <rect width="240" height="140" fill="#b8eae0"/>
          <!-- Doctor illustration -->
          <circle cx="120" cy="46" r="28" fill="#5cbdac"/>
          <ellipse cx="120" cy="112" rx="40" ry="26" fill="#3da895" />
          <!-- Stethoscope -->
          <path d="M100 75 Q88 100 100 112 Q112 124 128 116" stroke="white" stroke-width="3" fill="none" stroke-linecap="round" opacity="0.8"/>
          <circle cx="128" cy="115" r="6" fill="white" opacity="0.7"/>
          <circle cx="120" cy="46" r="16" fill="#7cd5c5"/>
        </svg>
      </div>
      <div class="login-card-body">
        <h3>Doctors Login</h3>
        <button class="btn-sm">Click Here</button>
      </div>
    </div>

    <div class="login-card">
      <div class="login-card-img">
        <svg viewBox="0 0 240 140" xmlns="http://www.w3.org/2000/svg">
          <rect width="240" height="140" fill="#d4f0eb"/>
          <!-- Admin illustration -->
          <rect x="70" y="40" width="100" height="70" rx="8" fill="#5cbdac" opacity="0.8"/>
          <rect x="80" y="52" width="80" height="8" rx="3" fill="white" opacity="0.7"/>
          <rect x="80" y="66" width="60" height="6" rx="3" fill="white" opacity="0.5"/>
          <rect x="80" y="78" width="70" height="6" rx="3" fill="white" opacity="0.5"/>
          <circle cx="170" cy="40" r="20" fill="#1abc9c"/>
          <rect x="164" y="32" width="12" height="4" rx="2" fill="white"/>
          <rect x="168" y="28" width="4" height="12" rx="2" fill="white"/>
        </svg>
      </div>
      <div class="login-card-body">
        <h3>Admin Login</h3>
        <button class="btn-sm">Click Here</button>
      </div>
    </div>

  </div>
</section>

<!-- KEY FEATURES -->
<section id="services" class="features">
  <h2 class="section-title">Our Key Features</h2>
  <p class="section-sub">Take a look at some of our key features</p>
  <div class="features-grid">

    <div class="feature-item">
      <div class="feature-icon">
        <!-- Heart/Cardiology icon -->
        <svg class="icon-svg" viewBox="0 0 24 24"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
      </div>
      <h4>Cardiology</h4>
    </div>

    <div class="feature-item">
      <div class="feature-icon">
        <!-- Bone/Ortho icon -->
        <svg class="icon-svg" viewBox="0 0 24 24"><path d="M17.5 3A3.5 3.5 0 0 0 14 6.5c0 .98.41 1.87 1.07 2.5l-8.07 8.07A3.5 3.5 0 0 0 6.5 17 3.5 3.5 0 0 0 3 20.5 3.5 3.5 0 0 0 6.5 24a3.5 3.5 0 0 0 3-1.69L17.5 14a3.5 3.5 0 0 0 3 1.69A3.5 3.5 0 0 0 24 12.2a3.5 3.5 0 0 0-3.5-3.5A3.5 3.5 0 0 0 17.5 3z" transform="scale(0.88) translate(1.5,1.5)"/></svg>
      </div>
      <h4>Orthopaedic</h4>
    </div>

    <div class="feature-item">
      <div class="feature-icon">
        <!-- Brain icon -->
        <svg class="icon-svg" viewBox="0 0 24 24"><path d="M13 3c-4.42 0-8 3.58-8 8v1h1c0 2.76 2.24 5 5 5h4c2.76 0 5-2.24 5-5s-2.24-5-5-5h-1c0-.55-.45-1-1-1V5c2.21 0 4 1.79 4 4h2c0-3.31-2.69-6-6-6z"/></svg>
      </div>
      <h4>Neurologist</h4>
    </div>

    <div class="feature-item">
      <div class="feature-icon">
        <!-- Pill icon -->
        <svg class="icon-svg" viewBox="0 0 24 24"><path d="M4.22 11.29l6.49-6.49a4.992 4.992 0 0 1 7.07 7.07l-6.49 6.49a4.992 4.992 0 1 1-7.07-7.07zM15.19 9.1l-6.1 6.1 1.41 1.41 6.1-6.1-1.41-1.41z"/></svg>
      </div>
      <h4>Pharma Pipeline</h4>
    </div>

    <div class="feature-item">
      <div class="feature-icon">
        <!-- Team icon -->
        <svg class="icon-svg" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
      </div>
      <h4>Pharma Team</h4>
    </div>

    <div class="feature-item">
      <div class="feature-icon">
        <!-- Quality icon -->
        <svg class="icon-svg" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
      </div>
      <h4>High Quality Treatments</h4>
    </div>

  </div>
</section>

<!-- ABOUT -->
<section id="about" class="about">
  <div class="about-images">
    <div class="about-img" style="background:linear-gradient(160deg,#7cd5c4,#1abc9c);">
      <svg viewBox="0 0 200 400" xmlns="http://www.w3.org/2000/svg" width="120" height="200" opacity="0.5">
        <circle cx="100" cy="80" r="45" fill="white"/>
        <ellipse cx="100" cy="260" rx="65" ry="90" fill="white"/>
        <path d="M75 120 Q55 170 70 195 Q88 220 115 205" stroke="rgba(255,255,255,0.7)" stroke-width="5" fill="none" stroke-linecap="round"/>
        <circle cx="115" cy="203" r="10" fill="rgba(255,255,255,0.6)"/>
      </svg>
    </div>
    <div class="about-img" style="background:linear-gradient(135deg,#9ae3d5,#3db9a5);">
      <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="80" height="80" opacity="0.5">
        <rect x="50" y="40" width="100" height="120" rx="12" fill="white"/>
        <rect x="65" y="60" width="70" height="8" rx="4" fill="rgba(26,188,156,0.5)"/>
        <rect x="65" y="76" width="50" height="6" rx="3" fill="rgba(26,188,156,0.3)"/>
        <rect x="65" y="90" width="60" height="6" rx="3" fill="rgba(26,188,156,0.3)"/>
      </svg>
    </div>
    <div class="about-img" style="background:linear-gradient(135deg,#c5ede6,#60c5b5);">
      <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="80" height="80" opacity="0.5">
        <circle cx="100" cy="70" r="40" fill="white"/>
        <ellipse cx="100" cy="155" rx="50" ry="35" fill="white"/>
      </svg>
    </div>
  </div>
  <div class="about-content">
    <h2>About Our Hospital</h2>
    <p>The Hospital Management System (HMS) is designed for any hospital to replace their existing manual, paper-based system. The new system controls the following information: patient information, room availability, staff and operating room schedules, and patient invoices.</p>
    <br/>
    <p>These services are to be provided in an efficient, cost-effective manner, with the goal of reducing the time and resources currently required for such tasks. A significant part of the operation of any hospital involves the acquisition, management and timely retrieval of great volumes of information.</p>
    <br/>
    <p>This information typically involves patient personal information, medical history, staff information, room and ward scheduling, staff scheduling, operating theater scheduling and various facilities waiting lists. All of this information must be managed in an efficient and cost-wise fashion so that an institution's resources may be effectively utilized.</p>
  </div>
</section>

<!-- GALLERY -->
<section id="gallery" class="gallery">
  <h2 class="section-title">Our Gallery</h2>
  <p class="section-sub">View Our Gallery</p>
  <div class="gallery-filters">
    <button class="filter-btn active">All</button>
    <button class="filter-btn">Dental</button>
    <button class="filter-btn">Cardiology</button>
    <button class="filter-btn">Neurology</button>
    <button class="filter-btn">Laboratory</button>
  </div>
  <div class="gallery-grid">
    <div class="gallery-item"><div class="gallery-item-inner g1">
      <svg viewBox="0 0 320 200" xmlns="http://www.w3.org/2000/svg">
        <circle cx="160" cy="80" r="50" fill="rgba(255,255,255,0.2)"/>
        <ellipse cx="160" cy="165" rx="60" ry="40" fill="rgba(255,255,255,0.15)"/>
        <circle cx="100" cy="60" r="30" fill="rgba(255,255,255,0.1)"/>
        <path d="M130 90 Q110 130 130 148 Q150 166 175 152" stroke="rgba(255,255,255,0.5)" stroke-width="4" fill="none" stroke-linecap="round"/>
        <circle cx="175" cy="150" r="8" fill="rgba(255,255,255,0.4)"/>
      </svg>
    </div></div>
    <div class="gallery-item"><div class="gallery-item-inner g2">
      <svg viewBox="0 0 320 200" xmlns="http://www.w3.org/2000/svg">
        <rect x="90" y="50" width="140" height="100" rx="14" fill="rgba(255,255,255,0.18)"/>
        <rect x="110" y="68" width="100" height="10" rx="4" fill="rgba(255,255,255,0.4)"/>
        <rect x="110" y="84" width="80" height="8" rx="3" fill="rgba(255,255,255,0.28)"/>
        <rect x="110" y="98" width="90" height="8" rx="3" fill="rgba(255,255,255,0.28)"/>
        <circle cx="220" cy="52" r="22" fill="rgba(255,255,255,0.25)"/>
        <rect x="214" y="43" width="12" height="4" rx="2" fill="rgba(255,255,255,0.6)"/>
        <rect x="218" y="39" width="4" height="12" rx="2" fill="rgba(255,255,255,0.6)"/>
      </svg>
    </div></div>
    <div class="gallery-item"><div class="gallery-item-inner g3">
      <svg viewBox="0 0 320 200" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="160" cy="100" rx="80" ry="60" fill="rgba(255,255,255,0.15)"/>
        <path d="M100 100 Q120 60 160 70 Q200 80 220 100 Q200 140 160 130 Q120 120 100 100z" fill="rgba(255,255,255,0.22)"/>
        <circle cx="160" cy="100" r="18" fill="rgba(255,255,255,0.35)"/>
      </svg>
    </div></div>
    <div class="gallery-item"><div class="gallery-item-inner g4">
      <svg viewBox="0 0 320 200" xmlns="http://www.w3.org/2000/svg">
        <circle cx="160" cy="90" r="55" fill="rgba(255,255,255,0.15)"/>
        <circle cx="160" cy="90" r="35" fill="rgba(255,255,255,0.2)"/>
        <circle cx="160" cy="90" r="15" fill="rgba(255,255,255,0.35)"/>
      </svg>
    </div></div>
    <div class="gallery-item"><div class="gallery-item-inner g5">
      <svg viewBox="0 0 320 200" xmlns="http://www.w3.org/2000/svg">
        <rect x="60" y="60" width="80" height="80" rx="10" fill="rgba(255,255,255,0.18)"/>
        <rect x="180" y="60" width="80" height="80" rx="10" fill="rgba(255,255,255,0.18)"/>
        <rect x="120" y="80" width="80" height="40" rx="8" fill="rgba(255,255,255,0.22)"/>
      </svg>
    </div></div>
    <div class="gallery-item"><div class="gallery-item-inner g6">
      <svg viewBox="0 0 320 200" xmlns="http://www.w3.org/2000/svg">
        <circle cx="120" cy="90" r="45" fill="rgba(255,255,255,0.2)"/>
        <ellipse cx="120" cy="160" rx="40" ry="25" fill="rgba(255,255,255,0.15)"/>
        <path d="M130 60 Q145 80 135 95 Q155 80 175 90" stroke="rgba(255,255,255,0.4)" stroke-width="3" fill="none"/>
      </svg>
    </div></div>
  </div>
</section>

<!-- CONTACT FORM -->
<section id="contact" class="contact">
  <div class="contact-form">
    <h2>Contact Form</h2>
    <div class="form-row">
      <label>Enter Name :</label>
      <input type="text" placeholder="Enter Name"/>
    </div>
    <div class="form-row">
      <label>Email Address :</label>
      <input type="email" placeholder="Enter Email Address"/>
    </div>
    <div class="form-row">
      <label>Mobile Number :</label>
      <input type="tel" placeholder="Enter Mobile Number"/>
    </div>
    <div class="form-row">
      <label>Enter Message :</label>
      <textarea placeholder="Write Your Message"></textarea>
    </div>
    <button class="btn-primary" style="margin-top:8px; padding: 12px 32px; font-size:0.9rem;">Send Message</button>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div>
    <h3>Useful Links</h3>
    <ul class="footer-links">
      <li>About us</li>
      <li>Services</li>
      <li>Logins</li>
      <li>Gallery</li>
      <li>Contact us</li>
      <li>Hospital Management System</li>
    </ul>
  </div>
  <div>
    <h3>Contact Us</h3>
    <div class="contact-info">
      <p>D-204, Hole Town South West, Delhi-110096, India</p>
      <p><span>Phone:</span> 1122334455</p>
      <p><span>Email:</span> info@gmail.com</p>
      <p><span>Timing:</span> 9am To 8 Pm</p>
    </div>
  </div>
</footer>
<div class="footer-bottom">
  &copy; 2024 Hospital Management System. All Rights Reserved.
</div>

</body>
</html>