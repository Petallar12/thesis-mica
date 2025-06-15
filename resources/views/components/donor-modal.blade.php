
<link rel="stylesheet" href="{{ asset('css/guest-modal.css') }}">

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
                  <div class="input-group">
                      <label>First Name *</label>
                      <input type="text" name="first_name" required />
                  </div>
                  <div class="input-group">
                      <label>Middle Name *</label>
                      <input type="text" name="middle_name" required />
                  </div>
                  <div class="input-group">
                      <label>Last Name *</label>
                      <input type="text" name="last_name" required />
                  </div>
                  <div class="input-group">
                      <label>Government ID *</label>
                      <input type="text" name="goverment_id_number" required />
                  </div>
                  <div class="input-group">
                      <label>Blood Type *</label>
                      <select name="blood_type" required>
                          <option value="">Select Blood Type</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="B-">B-</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                      </select>
                  </div>
                  <div class="input-group">
                      <label>Registration Date *</label>
                      <input type="date" name="encoded_date" value="{{ date('Y-m-d') }}" required readonly />
                  </div>
                  <div class="input-group">
                      <label>Donor Status *</label>
                      <select name="status" required>
                          <option value="">Select Status</option>
                          <option value="Active">Active</option>
                      </select>
                  </div>
                  <div class="input-group">
                      <label>Age *</label>
                      <input type="number" name="age" required min="0" />
                  </div>
                  <div class="input-group">
                      <label>Gender *</label>
                      <select name="gender" required>
                          <option value="">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>
                      </select>
                  </div>
              </div>
          </div>

          <div id="medical" class="tab-content">
              <div class="form-group">
                  <div class="input-group">
                      <label>Medical History *</label>
                      <input type="text" name="medical_history" required />
                  </div>
                  <div class="input-group">
                      <label>Waiting Time *</label>
                      <input type="text" name="waiting_time" required />
                  </div>
                  <div class="input-group">
                      <label>Donation Preferences *</label>
                      <input type="text" name="donation_preferences" required />
                  </div>
                  <div class="input-group">
                      <label>Organ Available/Needed *</label>
                      <input type="text" name="organ_needed" required />
                  </div>
              </div>
          </div>

          <div id="contact" class="tab-content">
              <div class="form-group">
                  <div class="input-group">
                      <label>Email Address *</label>
                      <input type="email" name="contact_information" required />
                  </div>
                  <div class="input-group">
                      <label>Contact Number *</label>
                      <input type="text" name="contact_number" required />
                  </div>
                  <div class="input-group">
                      <label>Registered By *</label>
                      <input type="text" name="encoded_by" required />
                  </div>
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
          openBtn.addEventListener('click', () => {
              modal.style.display = 'block';
              document.body.style.overflow = 'hidden'; // Prevent background scrolling
          });
          closeBtn.addEventListener('click', () => {
              modal.style.display = 'none';
              document.body.style.overflow = 'auto'; // Restore scrolling
          });
          cancelBtn.addEventListener('click', () => {
              modal.style.display = 'none';
              document.body.style.overflow = 'auto'; // Restore scrolling
          });

          window.onclick = (e) => {
              if (e.target === modal) {
                  modal.style.display = 'none';
                  document.body.style.overflow = 'auto'; // Restore scrolling
              }
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
  