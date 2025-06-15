<!-- donor-modal.blade.php -->
<link rel="stylesheet" href="{{ asset('css/donor-modal.css') }}" />


<div id="donorModal" class="modal">
  <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>REGISTER TO BE A DONOR</h2>
      <div id="successMessage" class="success-message"></div>
      <br/><br/>

      <form id="donorForm" method="POST" action="{{ route('donor.store') }}">
          @csrf

          <div class="tabs">
              <button type="button" class="tab active" data-tab="personal">Personal Information</button>
              <button type="button" class="tab" data-tab="medical">Medical Information</button>
              <button type="button" class="tab" data-tab="contact">Contact Information</button>
          </div>

          <div id="personal" class="tab-content active">
              <div class="form-group">
                  <input type="text" name="first_name" placeholder="First Name *" required />
                  <input type="text" name="middle_name" placeholder="Middle Name *" required />
                  <input type="text" name="last_name" placeholder="Last Name *" required />
                  <input type="text" name="goverment_id_number" placeholder="Government-issued ID Number *" required />
                  <select name="blood_type" required>
                    <option value="">Select Blood Type *</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>


                </select>


                  <input type="date" name="encoded_date" placeholder="Registered Date *" required />
                  <select name="status" required>
                    <option value="">Donor Status *</option>
                    <option value="Active">Active</option>
                </select>
                  <input type="number" name="age" placeholder="Age *" required min="0" />
                  <select name="gender" required>
                      <option value="">Select Gender *</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                  </select>
              </div>
          </div>

          <div id="medical" class="tab-content">
              <div class="form-group">
                  <input type="text" name="medical_history" placeholder="Medical History *" required />
                  <input type="text" name="waiting_time" placeholder="Estimated Waiting Time *" required />
                  <input type="text" name="donation_preferences" placeholder="Donation Preferences *" required />
                  <input type="text" name="organ_needed" placeholder="Organ Available/Needed *" required />
              </div>
          </div>

          <div id="contact" class="tab-content">
              <div class="form-group">
                  <input type="text" name="contact_information" placeholder="Email Address *" required />
                  <input type="text" name="contact_number" placeholder="Contact Number *" required />
              </div>
              <div class="form-group">
              <input type="text" name="encoded_by" placeholder="Registered by *" required />
            </div> 
          </div>

          <div class="form-actions">
              <button type="button" class="cancel-btn">Cancel</button>
              <button type="submit" class="submit-btn">Submit</button>
          </div>
      </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
      const modal = document.getElementById('donorModal');
      const openBtn = document.querySelector('.register-btn');
      const closeBtn = document.querySelector('.close-btn');
      const cancelBtn = document.querySelector('.cancel-btn');
      const tabs = document.querySelectorAll('.tab');
      const tabContents = document.querySelectorAll('.tab-content');
      const form = document.getElementById('donorForm');
      const successMessage = document.getElementById('successMessage');

      // Modal controls
      if (openBtn && modal && closeBtn && cancelBtn) {
          openBtn.addEventListener('click', () => modal.style.display = 'block');
          closeBtn.addEventListener('click', () => modal.style.display = 'none');
          cancelBtn.addEventListener('click', () => modal.style.display = 'none');

          window.onclick = (e) => {
              if (e.target === modal) modal.style.display = 'none';
          };
      }

      // Tab controls
      tabs.forEach(tab => {
          tab.addEventListener('click', () => {
              tabs.forEach(t => t.classList.remove('active'));
              tabContents.forEach(content => content.classList.remove('active'));
              
              tab.classList.add('active');
              const tabId = tab.getAttribute('data-tab');
              document.getElementById(tabId).classList.add('active');
          });
      });

      // Form submission
      form.addEventListener('submit', async (e) => {
          e.preventDefault();
          
          try {
              const formData = new FormData(form);
              const response = await fetch(form.action, {
                  method: 'POST',
                  body: formData,
                  headers: {
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                      'Accept': 'application/json'
                  }
              });

              const result = await response.json();
              
              if (result.success) {
                  // Hide the form and show success message
                  form.style.display = 'none';
                  successMessage.textContent = result.message;
                  successMessage.style.display = 'block';
                  
                  // Reload the page after 3 seconds
                  setTimeout(() => {
                      window.location.reload();
                  }, 3000);
              }
          } catch (error) {
              console.error('Error:', error);
              successMessage.textContent = 'An error occurred. Please try again.';
              successMessage.style.display = 'block';
              successMessage.style.backgroundColor = '#f44336';
          }
      });
  });
</script>
  