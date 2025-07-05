<!-- Create Recipient Modal -->
<link rel="stylesheet" href="{{ asset('css/donor-modal.css') }}">
<style>
    .modal-backdrop {
        background-color: transparent !important;
    }
</style>

<div class="modal fade" id="createRecipientModal" tabindex="-1" aria-labelledby="createRecipientModalLabel" aria-hidden="true" style="background-color: transparent !important;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <span class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</span>
            <h2 class="modal-title" id="createRecipientModalLabel">Add New Recipient</h2>
            
            <div class="tabs">
                <button type="button" class="tab active" data-tab="create-personal">Personal Information</button>
                <button type="button" class="tab" data-tab="create-kin">Next of Kin</button>
                <button type="button" class="tab" data-tab="create-medical">Medical Information</button>
                <button type="button" class="tab" data-tab="create-transplant">Transplant Info</button>
                <button type="button" class="tab" data-tab="create-scheduling">Scheduling</button>
                <button type="button" class="tab" data-tab="create-contact">Contact Information</button>
            </div>

            <div class="modal-body">
                <div id="recipientNotification" class="success-message" style="display:none;"></div>
                <div id="recipientError" class="error-message" style="display:none; background: #e74c3c; color: #fff; padding: 1rem; border-radius: 6px; margin-bottom: 1rem; text-align: center;"></div>
                <form id="createRecipientForm" method="POST" action="{{ route('recipients.store') }}" class="mt-4">
                    @csrf

                    <div id="create-personal" class="tab-content active">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>First Name <span class="required">*</span></label>
                                <input type="text" name="first_name" required />
                            </div>
                            <div class="input-group">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" />
                            </div>
                            <div class="input-group">
                                <label>Last Name <span class="required">*</span></label>
                                <input type="text" name="last_name" required />
                            </div>
                            <div class="input-group">
                                <label>Government ID Number <span class="required">*</span></label>
                                <input type="text" name="goverment_id_number" required />
                            </div>
                            <div class="input-group">
                                <label>Blood Type <span class="required">*</span></label>
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
                            {{-- <div class="input-group">
                                <label>Age <span class="required">*</span></label>
                                <input type="number" name="age" required min="0" />
                            </div> --}}
                            <div class="input-group">
                                <label>Gender <span class="required">*</span></label>
                                <select name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Birthday</label>
                                <input type="date" name="birthday" />
                            </div>
                            <div class="input-group">
                                <label>Nationality</label>
                                <select name="nationality" id="create-nationality-select">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Address</label>
                                <input type="text" name="address" />
                            </div>
                            <div class="input-group">
                                <label>Status <span class="required">*</span></label>
                                <select name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="create-kin" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Kin Full Name</label>
                                <input type="text" name="kin_fullname" />
                            </div>
                            <div class="input-group">
                                <label>Relationship to Recipient</label>
                                <input type="text" name="relationship_to_recipient" />
                            </div>
                            <div class="input-group">
                                <label>Kin Contact Number</label>
                                <input type="text" name="kin_contact_number" />
                            </div>
                            <div class="input-group">
                                <label>Kin Email</label>
                                <input type="email" name="kin_email" />
                            </div>
                            <div class="input-group">
                                <label>Kin Address</label>
                                <input type="text" name="kin_address" />
                            </div>
                        </div>
                    </div>

                    <div id="create-medical" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Medical History <span class="required">*</span></label>
                                <input type="text" name="medical_history" />
                            </div>
                            <div class="input-group">
                                <label>HLA Typing</label>
                                <select name="hla_typing" required>
                                    <option value="">Select HLA Type</option>
                                    <option value="HLA-A">HLA-A</option>
                                    <option value="HLA-B">HLA-B</option>
                                    <option value="HLA-DR"> HLA-DR</option>
                                    <option value="None">None</option>
                                </select>                            
                            </div>
                            <div class="input-group">
                                <label>Medical Condition</label>
                                <input type="text" name="medical_condition" />
                            </div>
                            <div class="input-group">
                                <label>Medical Urgency Score</label>
                                <input type="number" name="medical_urgency_score" min="0" max="10" />
                            </div>
                            <div class="input-group">
                                <label>Date Listed</label>
                                <input type="date" name="date_listed" />
                            </div>
                            <div class="input-group">
                                <label>Immunologic Sensitization</label>
                                <select name="immunologic_sensitization" required>
                                    <option value="">Immunologic Sensitization</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                    <option value="Not Applicable">Not Applicable</option>                                    
                                </select>                              
                            </div>
                            <div class="input-group">
                                <label>Priority Score</label>
                                <input type="number" name="priority_score" min="0" max="100" />
                            </div>
                            <div class="input-group">
                                <label>Waiting Time (months) <span class="required">*</span></label>
                                <input type="number" name="waiting_time" required />
                            </div>
                        </div>
                    </div>

                    <div id="create-transplant" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Organ Needed <span class="required">*</span></label>
                                <select name="organ_needed" id="create-organ-select" required>
                                    <option value="">Select Organ</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Match Attempts</label>
                                <input type="number" name="match_attempts" min="0" />
                            </div>
                            <div class="input-group">
                                <label>Transplant Status</label>
                                <select name="transplant_status">
                                    <option value="">Select Status</option>
                                    <option value="Waiting">Waiting</option>
                                    <option value="Matched">Matched</option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Donation Preferences</label>
                                <input type="text" name="donation_preferences" />
                            </div>
                        </div>
                    </div>

                    <div id="create-scheduling" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Scheduled Transplant Date</label>
                                <input type="date" name="scheduled_transplant_date" />
                            </div>
                            <div class="input-group">
                                <label>Transplantation Time</label>
                                <input type="time" name="transplantation_time" />
                            </div>
                            <div class="input-group">
                                <label>Operating Room Availability</label>
                                <input type="text" name="operating_room_availaility" />
                            </div>
                            <div class="input-group">
                                <label>Transplant Surgeon</label>
                                <input type="text" name="transplant_surgeon" />
                            </div>
                            <div class="input-group">
                                <label>Surgical Team Availability</label>
                                <input type="text" name="surgical_team_availability" />
                            </div>
                            <div class="input-group">
                                <label>Hospital Location</label>
                                <input type="text" name="hospital_location" />
                            </div>
                            <div class="input-group">
                                <label>Transport Arrangement</label>
                                <input type="text" name="transport_arrangement" />
                            </div>
                        </div>
                    </div>

                    <div id="create-contact" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Email Address <span class="required">*</span></label>
                                <input type="email" name="contact_information" required />
                            </div>
                            <div class="input-group">
                                <label>Contact Number <span class="required">*</span></label>
                                <input type="text" name="contact_number" required />
                            </div>
                            <div class="input-group">
                                <label>Encoded By <span class="required">*</span></label>
                                <input type="text" name="encoded_by" value="{{ Auth::user()->name }}" required readonly />
                            </div>
                            <div class="input-group">
                                <label>Encoded Date <span class="required">*</span></label>
                                <input type="date" name="encoded_date" value="{{ date('Y-m-d') }}" required readonly />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="form-actions">
                <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="submit-btn" id="saveRecipientBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nationalitySelect = document.getElementById('create-nationality-select');
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
    const organSelect = document.getElementById('create-organ-select');
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
});
</script> 