@include('components.donor-modal')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Philippine Network for Organ Sharing</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />


</head>
<body>
  <header>
    <div class="logo">
      <img src="images/logo.png" alt="Logo" />
    </div>
    <nav>
      <button class="contact-btn">Contact</button>
      <button class="register-btn">Register Now</button>
    </nav>
  </header>

  <!-- Top Full Image Only -->
  <section class="top_image">
    <img src="images/doctor.jpg" alt="Full Banner Image"/>
  </section>

  <!-- Content Section -->
  <section class="content-section">
    <!-- Second Image Block -->
    <div class="content-block">
      <div class="iframe-box">
        <img src="images/heart.jpg" alt="Heart Image"/>
      </div>
      <div class="text">
        <h2>Thousands Are Waiting.<br>Few Get the Call.</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <button class="cta">CTA</button>
      </div>
    </div>

    <!-- Third Image Block -->
    <div class="content-block reverse">
      <div class="iframe-box">
        <img src="images/liver.jpg" alt="Liver Image"/>
      </div>
      <div class="text">
        <h2>Thousands Are Waiting.<br>Few Get the Call.</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <button class="cta">CTA</button>
      </div>
    </div>
  </section>
  <!-- Cards Section -->
<div class="cards-section">
    <div class="card">
      <h4>Coordinate & Transplant</h4>
      <p>Hospitals and transplant centers join the nationwide network with verified access.</p>
    </div>
    <div class="card">
      <h4>Coordinate & Transplant</h4>
      <p>Hospitals and transplant centers join the nationwide network with verified access.</p>
    </div>
    <div class="card">
      <h4>Coordinate & Transplant</h4>
      <p>Hospitals and transplant centers join the nationwide network with verified access.</p>
    </div>
    <div class="card">
      <h4>Coordinate & Transplant</h4>
      <p>Hospitals and transplant centers join the nationwide network with verified access.</p>
    </div>

  </div>
</div>
<div></div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const modal = document.getElementById('donorModal');
      const openBtn = document.querySelector('.register-btn');
      const closeBtn = document.querySelector('.close-btn');
      const cancelBtn = document.querySelector('.cancel-btn');
  
      if (openBtn && modal && closeBtn && cancelBtn) {
          openBtn.addEventListener('click', () => modal.style.display = 'block');
          closeBtn.addEventListener('click', () => modal.style.display = 'none');
          cancelBtn.addEventListener('click', () => modal.style.display = 'none');
  
          window.onclick = (e) => {
              if (e.target === modal) modal.style.display = 'none';
          };
      } else {
          console.error("Modal elements not found in DOM.");
      }
    });
  </script>
  
</html>
