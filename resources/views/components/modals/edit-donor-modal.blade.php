<link rel="stylesheet" href="{{ asset('css/donor-modal.css') }}">
<style>
    .modal-backdrop {
        background-color: transparent !important;
    }
</style>

<!-- Modal for editing donor -->
<div class="modal fade" id="editDonorModal" tabindex="-1" aria-labelledby="editDonorModalLabel" aria-hidden="true" style="background-color: transparent !important;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</span>
            <h2 class="modal-title" id="editDonorModalLabel">Edit Donor</h2>
            
            <div class="tabs">
                <button type="button" class="tab active" data-tab="edit-personal">Personal Information</button>
                <button type="button" class="tab" data-tab="edit-kin-information">Kin Information</button>
                <button type="button" class="tab" data-tab="edit-medical">Medical Information</button>
                <button type="button" class="tab" data-tab="edit-organ-specific-information">Organ-Specific Information</button>
                <button type="button" class="tab" data-tab="edit-system-information">System Information</button>
                <button type="button" class="tab" data-tab="edit-others">Others</button>
                {{-- <button type="button" class="tab" data-tab="edit-contact">Contact Information</button> --}}
            </div>

            <div class="modal-body">
                <div id="editSuccessMessage" class="success-message"></div>
                <form id="editDonorForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div id="edit-personal" class="tab-content active">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>First Name <span class="required">*</span></label><input type="text" name="first_name" required /></div>
                            <div class="input-group"><label>Middle Name</label><input type="text" name="middle_name" /></div>
                            <div class="input-group"><label>Last Name <span class="required">*</span></label><input type="text" name="last_name" required /></div>
                            <div class="input-group"><label>Gender <span class="required">*</span></label><select name="gender" required><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></div>
                            <div class="input-group"><label>Birthday</label><input type="date" name="birthday" /></div>
                            {{-- <div class="input-group"><label>Age <span class="required">*</span></label><input type="number" name="age" min="0" required /></div> --}}
                            <div class="input-group"><label>Nationality</label>
                                <select name="nationality" id="edit-donor-nationality-select">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Contact Number</label><input type="text" name="contact_number" /></div>
                            <div class="input-group"><label>Email Address</label><input type="email" name="contact_information" /></div>
                            <div class="input-group"><label>Government ID Number</label><input type="text" name="goverment_id_number" /></div>
                            <div class="input-group"><label>Address</label><input type="text" name="address" /></div>
                        </div>
                    </div>

                    <div id="edit-kin-information" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Kin Full Name</label><input type="text" name="kin_fullname" /></div>
                            <div class="input-group"><label>Relationship to Donor</label>
                                <select name="relationship_to_donor" id="edit-relationship-to-donor-select" required>
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
                            <div class="input-group"><label>Kin Consent</label><input type="text" name="kin_consent" /></div>
                        </div>
                    </div>

                    <div id="edit-medical" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Blood Type <span class="required">*</span></label><select name="blood_type" required><option value="">Select Blood Type</option><option value="O+">O+</option><option value="O-">O-</option><option value="A+">A+</option><option value="A-">A-</option><option value="B+">B+</option><option value="B-">B-</option><option value="AB+">AB+</option><option value="AB-">AB-</option></select></div>
                            <div class="input-group"><label>Height</label><input type="number" name="height" step="0.01" /></div>
                            <div class="input-group"><label>Weight</label><input type="number" name="weight" step="0.01" /></div>
                            <div class="input-group"><label>Cause of Death</label><input type="text" name="cause_of_death" /></div>
                            <div class="input-group"><label>Brain Death Confirmation</label><input type="text" name="brain_death_confirmation" /></div>
                            <div class="input-group"><label>Medical History</label><input type="text" name="medical_history" /></div>
                            <div class="input-group"><label>Communicable Diseases</label>
                                <select name="communicable_diseases" id="edit-communicable-diseases-select">
                                    <option value="">Select Communicable Diseases</option>
                                    <option value="HIV">HIV</option>
                                    <option value="TB">TB</option>
                                    <option value="Hepatitis B">Hepatitis B</option>
                                    <option value="Hepatitis C">Hepatitis C</option>
                                    <option value="None">None</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Organ Viability Status</label>
                                <select name="organ_viability_status" id="edit-organ-viability-status-select">
                                    <option value="">Select Organ Viability Status</option>
                                    <option value="Viable">Viable</option>
                                    <option value="Not Viable">Not Viable</option>
                                    <option value="Pending Evaluation">Pending Evaluation</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Donor Status</label>
                                <select name="donor_status" id="edit-donor-status-select">
                                    <option value="">Select Donor Status</option>
                                    <option value="Deceased">Deceased</option>
                                    <option value="Not Applicable">Not Applicable</option>
                                    <option value="Pending Evaluation">Pending Evaluation</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Status</label>
                                <select name="status" id="edit-status-select">
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Consent Type</label>
                                <select name="consent_type" id="edit-consent-type-select">
                                    <option value="">Select Consent Type</option>
                                    <option value="Donor Card">Donor Card</option>
                                    <option value="Family Consent">Family Consent</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Donation Type</label>
                                <select name="donation_type" id="edit-donation-type-select">
                                    <option value="">Select Status</option>
                                    <option value="Transplantation">Transplantation</option>
                                    <option value="Research and Education">Research and Education</option>
                                    <option value="Both">Both</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="edit-organ-specific-information" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Organ Needed <span class="required">*</span></label>
                                <select name="organ_needed" id="edit-donor-organ-select" required>
                                    <option value="">Select Organ</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Organ Size</label><input type="text" name="organ_size" /></div>
                            <div class="input-group"><label>Organ Function</label><input type="text" name="ogran_function" /></div>
                            <div class="input-group"><label>Retrieval Time</label><input type="time" name="retrieval_time" /></div>
                            <div class="input-group"><label>Organ Preservation Status</label><input type="text" name="organ_preservation_status" /></div>
                            <div class="input-group"><label>Condition of Organs</label><input type="text" name="condition_of_organs" /></div>
                            <div class="input-group"><label>Organ Compatibility</label><input type="text" name="organ_compability" /></div>
                            <div class="input-group"><label>Organ Recovery Team</label><input type="text" name="organ_recovery_team" /></div>
                        </div>
                    </div>

                    <div id="edit-system-information" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Donor Card Registration Date</label><input type="date" name="donor_card_registration_date" /></div>
                            <div class="input-group"><label>Registration Method</label><input type="text" name="registration_method" /></div>
                            <div class="input-group"><label>Notification Set to Family</label><input type="text" name="notification_set_to_family" /></div>
                            <div class="input-group"><label>Donor Card QR Code</label><input type="text" name="donor_card_qr_code" /></div>
                        </div>
                    </div>

                    <div id="edit-others" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            
                            <div class="input-group"><label>Donation Purpose</label><input type="text" name="donation_purpose" /></div>
                            <div class="input-group"><label>Condition for Donation</label><input type="text" name="condition_for_donation" /></div>
                            <div class="input-group"><label>Signature</label><input type="text" name="signature" /></div>
                            <div class="input-group"><label>Today's Date</label><input type="date" name="todays_date" /></div>
                            <div class="input-group"><label>Waiting Time <span class="required">*</span></label><input type="text" name="waiting_time" required /></div>
                            <div class="input-group"><label>Donation Preferences <span class="required">*</span></label><input type="text" name="donation_preferences" required /></div>
                            <div class="input-group"><label>Encoded By</label><input type="text" name="encoded_by" /></div>
                            <div class="input-group"><label>Encoded Date</label><input type="date" name="encoded_date" /></div>
                        </div>
                    </div>

                    {{-- <div id="edit-contact" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Email Address</label><input type="email" name="contact_information" /></div>
                            <div class="input-group"><label>Contact Number</label><input type="text" name="contact_number" /></div>
                        </div>
                    </div> --}}
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="cancel-btn" id="updateDonorBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nationalitySelect = document.getElementById('edit-donor-nationality-select');
    if (nationalitySelect) {
        fetch('/countries.json')
            .then(response => response.json())
            .then(countries => {
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country;
                    option.textContent = country;
                    nationalitySelect.appendChild(option);
                });
            });
    }
    const organSelect = document.getElementById('edit-donor-organ-select');
    if (organSelect) {
        fetch('/organs.json')
            .then(response => response.json())
            .then(organs => {
                organs.forEach(organ => {
                    const option = document.createElement('option');
                    option.value = organ;
                    option.textContent = organ;
                    organSelect.appendChild(option);
                });
            });
    }

    // Set selected value for Relationship to Donor if editing
    const relSelect = document.getElementById('edit-relationship-to-donor-select');
    if (relSelect && window.editDonorData && window.editDonorData.relationship_to_donor) {
        relSelect.value = window.editDonorData.relationship_to_donor;
    }

    // Set selected value for Communicable Diseases if editing
    const commSelect = document.getElementById('edit-communicable-diseases-select');
    if (commSelect && window.editDonorData && window.editDonorData.communicable_diseases) {
        commSelect.value = window.editDonorData.communicable_diseases;
    }

    // Set selected value for Organ Viability Status if editing
    const organViabilitySelect = document.getElementById('edit-organ-viability-status-select');
    if (organViabilitySelect && window.editDonorData && window.editDonorData.organ_viability_status) {
        organViabilitySelect.value = window.editDonorData.organ_viability_status;
    }

    // Set selected value for Donor Status if editing
    const donorStatusSelect = document.getElementById('edit-donor-status-select');
    if (donorStatusSelect && window.editDonorData && window.editDonorData.donor_status) {
        donorStatusSelect.value = window.editDonorData.donor_status;
    }

    // Set selected value for Status if editing
    const statusSelect = document.getElementById('edit-status-select');
    if (statusSelect && window.editDonorData && window.editDonorData.status) {
        statusSelect.value = window.editDonorData.status;
    }

    // Set selected value for Consent Type if editing
    const consentTypeSelect = document.getElementById('edit-consent-type-select');
    if (consentTypeSelect && window.editDonorData && window.editDonorData.consent_type) {
        consentTypeSelect.value = window.editDonorData.consent_type;
    }

    // Set selected value for Donation Type if editing
    const donationTypeSelect = document.getElementById('edit-donation-type-select');
    if (donationTypeSelect && window.editDonorData && window.editDonorData.donation_type) {
        donationTypeSelect.value = window.editDonorData.donation_type;
    }
});
</script> 