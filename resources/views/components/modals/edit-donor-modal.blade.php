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
                <button type="button" class="tab" data-tab="edit-contact">Contact Information</button>
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
                            <div class="input-group"><label>Nationality</label><input type="text" name="nationality" /></div>
                            <div class="input-group"><label>Contact Number</label><input type="text" name="contact_number" /></div>
                            <div class="input-group"><label>Email Address</label><input type="email" name="contact_information" /></div>
                            <div class="input-group"><label>Government ID Number</label><input type="text" name="goverment_id_number" /></div>
                            <div class="input-group"><label>Address</label><input type="text" name="address" /></div>
                        </div>
                    </div>

                    <div id="edit-kin-information" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Kin Full Name</label><input type="text" name="kin_fullname" /></div>
                            <div class="input-group"><label>Relationship to Donor</label><input type="text" name="relationship_to_donor" /></div>
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
                            <div class="input-group"><label>Medical History</label><textarea name="medical_history"></textarea></div>
                            <div class="input-group"><label>Communicable Diseases</label><input type="text" name="communicable_diseases" /></div>
                            <div class="input-group"><label>Organ Viability Status</label><input type="text" name="organ_viability_status" /></div>
                            <div class="input-group"><label>Donor Status</label><input type="text" name="donor_status" /></div>
                            <div class="input-group"><label>Status</label><input type="text" name="status" /></div>
                            <div class="input-group"><label>Consent Type</label><input type="text" name="consent_type" /></div>
                        </div>
                    </div>

                    <div id="edit-organ-specific-information" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Organ Needed <span class="required">*</span></label><input type="text" name="organ_needed" required /></div>
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
                            <div class="input-group"><label>Donation Type</label><input type="text" name="donation_type" /></div>
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

                    <div id="edit-contact" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group"><label>Email Address</label><input type="email" name="contact_information" /></div>
                            <div class="input-group"><label>Contact Number</label><input type="text" name="contact_number" /></div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="cancel-btn" id="updateDonorBtn">Update</button>
            </div>
        </div>
    </div>
</div> 