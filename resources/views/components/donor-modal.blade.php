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
              <button type="button" class="tab" data-tab="create-kin-information">Kin Information</button>
              <button type="button" class="tab" data-tab="organ-donation-preference">Organ Donation Preferences</button>
              <button type="button" class="tab" data-tab="medical">Medical Information</button>
              <button type="button" class="tab" data-tab="donor">Donor Card Information</button>
          </div>

          <div id="personal" class="tab-content active">
              <div class="form-group">
                  <div class="input-group">
                      <label>First Name *</label>
                      <input type="text" name="first_name" required />
                  </div>
                  <div class="input-group">
                      <label>Middle Name *</label>
                      <input type="text" name="middle_name" />
                  </div>
                  <div class="input-group">
                      <label>Last Name *</label>
                      <input type="text" name="last_name" required />
                  </div>
                  <div class="input-group">
                    <label>Gender *</label>
                    <select name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="input-group"><label>Birthday</label><input type="date" name="birthday" /></div>
                <div class="input-group">
                    <label>Nationality</label>
                    <select name="nationality" id="create-donor-nationality-select">
                        <option value="">Select Country</option>
                        <option value="Algeria">Algeria</option>
                        <option value="Albania">Albania</option>
                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                        <option value="Australia">Australia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Canada">Canada</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="China">China</option>
                        <option value="Columbia">Columbia</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Chile">Chile</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Europe">Europe</option>
                        <option value="East Africa">East Africa</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="France">France</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Germany">Germany</option>
                        <option value="Greece">Greece</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Korea (Republic)">Korea (Republic)</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="London">London</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Malta">Malta</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Norway">Norway</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russia</option>
                        <option value="Scotland">Scotland</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Korea">South Korea</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syria</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Togo">Togo</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States of America">United States of America</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Zealander">Zealander</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Email Address *</label>
                    <input type="email" name="contact_information" id="contact_information" required />
                    <button type="button" id="sendVerificationBtn" class="submit-btn" style="margin-top: 8px; width: 100%;">Send Verification Code</button>
                </div>
                <div class="input-group" id="verificationSection" style="display:none;">
                    <label>Enter Verification Code</label>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="text" id="verificationCode" placeholder="Enter code" style="flex: 2;" />
                        <button type="button" id="verifyCodeBtn" class="submit-btn" style="flex: 1; min-width: 100px;">Verify</button>
                    </div>
                </div>
                <div class="input-group">
                    <label>Contact Number *</label>
                    <input type="text" name="contact_number" />
                </div>
                  <div class="input-group">
                      <label>Government ID *</label>
                      <input type="text" name="goverment_id_number" required />
                  </div>
                  <div class="input-group"><label>Address</label><input type="text" name="address" /></div>
                  <div class="input-group">
                    <label>Registered Where</label>
                    <select name="register_outside_inside" required>
                        <option value="Website">Website</option>
                    </select>
                </div>
              </div>
          </div>

          <div id="create-kin-information" class="tab-content">
              <div class="form-group grid grid-cols-2 gap-4">
                  <div class="input-group"><label>Kin Full Name</label><input type="text" name="kin_fullname" /></div>
                  <div class="input-group"><label>Relationship to Donor</label>
                      <select name="relationship_to_donor" >
                          <option value="">Select Relationship</option>
                          <option value="Parent">Parent</option>
                          <option value="Sibling">Sibling</option>
                          <option value="Child">Child</option>
                          <option value="Friend">Friend</option>
                      </select>
                  </div>
                  <div class="input-group"><label>Kin Contact Number</label><input type="text" name="kin_contact_number" /></div>
                  <div class="input-group"><label>Kin Email</label><input type="email" name="kin_email" /></div>
                  <div class="input-group"><label>Kin Address</label><input type="text" name="kin_address" /></div>
                  <div class="input-group"><label>Kin Consent</label> 
                      <select name="kin_consent" >
                          <option value="">Select Consent</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                          <option value="Pending">Pending</option>
                      </select>
                  </div>
              </div>
          </div>
          <div id="organ-donation-preference" class="tab-content">
            <div class="form-group grid grid-cols-2 gap-4">
                <div class="input-group">
                    <label>Prefer Organ Donation *</label>
                    <select name="organ_needed" id="create-donor-organ-select" required>
                        <option value="">Select Organ</option>
                        <option value="Heart">Heart</option>
                        <option value="Kidneys">Kidneys</option>
                        <option value="Liver">Liver</option>
                        <option value="Lungs">Lungs</option>
                        <option value="Corneas">Corneas</option>
                        <option value="Bone Marrow">Bone Marrow</option>
                        <option value="Pancreas">Pancreas</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Donation Type</label>
                    <select name="donation_type" >
                        <option value="">Select Status</option>
                        <option value="Transplantation">Transplantation</option>
                        <option value="Research and Education">Research and Education</option>
                        <option value="Both">Both</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Donation Purpose</label>
                    <input type="text" name="donation_purpose" />
                </div>
                <div class="input-group"><label>Condition for Donation</label><input type="text" name="condition_for_donation" /></div>

            </div>
          </div>
        
          <div id="medical" class="tab-content">
              <div class="form-group">
                  {{-- <div class="input-group">
                      <label>Medical History *</label>
                      <input type="text" name="medical_history"  />
                  </div> --}}
                  <div class="input-group">
                    <label>Blood Type <span class="">*</span></label>
                    <select name="blood_type">
                        <option value="">Select Blood Type</option>
                        <option value="O">O</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A">A</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B">B</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB">AB</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="input-group"><label>Height</label><input type="number" name="height" step="0.01" /></div>
                <div class="input-group"><label>Weight</label><input type="number" name="weight" step="0.01" /></div>
                <div class="input-group"><label>Medical History</label><input type="text" name="medical_history" /></div>
                {{-- <div class="input-group">
                    <label>Transplant Status</label>
                    <select name="transplant_status">
                        <option value="">Select Status</option>
                        <option value="Waiting">Waiting</option>
                        <option value="Matched">Matched</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div> --}}

                {{-- <div class="input-group">
                      <label>Donation Preferences *</label>
                      <input type="text" name="donation_preferences"  />
                  </div>
                  <div class="input-group">
                      <label>Donate Organ *</label>
                      <input type="text" name="organ_needed"  />
                  </div> --}}
              </div>
          </div>

          <div id="donor" class="tab-content">
              <div class="form-group">
                <div class="input-group"><label>Donor Card Registration Date</label><input type="date" name="donor_card_registration_date" /></div>

                <div class="input-group">
                    <label>Registration Method<span class="">*</span></label>
                    <select name="registration_method" >
                        <option value="">Select Registration Method</option>
                        <option value="Web">Web</option>
                        <option value="App">App</option>
                        <option value="NKTI Office">NKTI Office</option>
                        <option value="LTO">LTO</option>
                    </select>
                </div>
                  <div class="input-group">
                      <label>Contact Number *</label>
                      <input type="text" name="contact_number" />
                  </div>
                  <div class="input-group">
                      <label>Registered By *</label>
                      <input type="text" name="encoded_by" />
                  </div>
              </div>
          </div>

          <div class="form-actions">
              <button type="button" class="cancel-btn">Cancel</button>
              <button type="submit" id="submitBtn" class="submit-btn" disabled>Submit</button>
          </div>
      </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

@push('scripts')
<script>
let emailVerified = false;

$('#sendVerificationBtn').on('click', function() {
    let email = $('#contact_information').val();
    if (!email) {
        alert('Please enter your email address first.');
        return;
    }
    $.post('/donor/send-verification', { email, _token: '{{ csrf_token() }}' }, function(res) {
        alert(res.message);
        $('#verificationSection').show();
    }).fail(function(xhr) {
        alert('Failed to send verification code.');
    });
});

$('#verifyCodeBtn').on('click', function() {
    let email = $('#contact_information').val();
    let code = $('#verificationCode').val();
    if (!code) {
        alert('Please enter the verification code.');
        return;
    }
    $.post('/donor/verify-code', { email, code, _token: '{{ csrf_token() }}' }, function(res) {
        if (res.verified) {
            emailVerified = true;
            alert('Email verified!');
            $('#submitBtn').prop('disabled', false);
        } else {
            alert('Invalid code.');
        }
    }).fail(function(xhr) {
        alert('Invalid code.');
    });
});

$('#donorForm').on('submit', function(e) {
    if (!emailVerified) {
        e.preventDefault();
        alert('Please verify your email first.');
    }
});
</script>
@endpush

@stack('scripts')
  