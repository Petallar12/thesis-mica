@include('components.donor-modal')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Philippine Network for Organ Sharing</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />


</head>
<body>
  <header>
    <div class="logo">
      <img src="images/logo.png" alt="Logo" />
    </div>
    <nav>
      {{-- <button class="contact-btn">Contact</button> --}}
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
        <h2>Thousands Are Waiting. Be Their Lifeline.</h2>
        <p>Every day, individuals across the world are waiting for a life-saving organ. The heartbreaking truth is that many won’t get the call in time. 
          But you have the power to change that. By registering as an organ donor, you can offer the gift of life. Your selfless decision could mean a 
          second chance for someone’s father, daughter, or friend. Donating organs saves lives and changes families forever.</p>
        {{-- <button class="cta">CTA</button> --}}
      </div>
    </div>

    <!-- Third Image Block -->
    <div class="content-block reverse">
      <div class="iframe-box">
        <img src="images/liver.jpg" alt="Liver Image"/>
      </div>
      <div class="text">
        <h2>You Can Give Them Hope.</h2>
        <p>Thousands of people are waiting for the organ transplant that could save their life. Sadly, only a few get that chance. 
          But you can help change the odds. Organ donation is a simple act with an immeasurable impact. Your decision to donate could mean the difference 
          between life and death for someone in need. By becoming an organ donor, you become a hero to someone who may never have had the chance.</p>
        {{-- <button class="cta">CTA</button> --}}
      </div>
    </div>
  </section>
  <!-- Cards Section -->
<div class="cards-section">
    <div class="card">
      <h4>Connect to Save Lives</h4>
      <p>Hospitals and transplant centers are at the forefront of making life-saving transplants possible. By joining the national network,
         you help connect patients with the organ donations they urgently need. Your collaboration saves lives across the country.</p>
    </div>
    <div class="card">
      <h4>Build a Stronger Network</h4>
      <p>Hospitals and transplant centers play a critical role in the transplant process. By connecting with the nationwide verified network,
         you ensure that every organ is maximized, every opportunity is seized, and every patient gets a chance at a new life.</p>
    </div>
    <div class="card">
      <h4>Empower Life-Saving Decisions
      </h4>
      <p>As part of the national transplant network, hospitals and centers gain verified access to the critical information that allows them to make quick,
         life-saving decisions for transplant candidates. Your partnership is the key to making more successful organ transplants a reality.</p>
    </div>
    <div class="card">
      <h4>Create Lasting Impact Together</h4>
      <p>The collaboration between hospitals, transplant centers, and the organ donation network makes a tangible difference.
         Your involvement not only enhances transplant efficiency but also ensures that the life-saving power of organ donation reaches as many people as possible.</p>
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
