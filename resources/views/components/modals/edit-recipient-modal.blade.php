<!-- Edit Recipient Modal -->
<div class="modal fade" id="editRecipientModal" tabindex="-1" aria-labelledby="editRecipientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</span>
            <h2 class="modal-title" id="editRecipientModalLabel">Edit Recipient</h2>
            
            <div class="tabs">
                <button type="button" class="tab active" data-tab="edit-personal">Personal Information</button>
                <button type="button" class="tab" data-tab="edit-medical">Medical Information</button>
                <button type="button" class="tab" data-tab="edit-contact">Contact Information</button>
            </div>

            <div class="modal-body">
                <div id="editSuccessMessage" class="success-message"></div>
                <form id="editRecipientForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div id="edit-personal" class="tab-content active">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>First Name *</label>
                                <input type="text" name="first_name" required />
                            </div>
                            <div class="input-group">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" />
                            </div>
                            <div class="input-group">
                                <label>Last Name *</label>
                                <input type="text" name="last_name" required />
                            </div>
                            <div class="input-group">
                                <label>Government ID Number *</label>
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
                                <label>Age *</label>
                                <input type="number" name="age" required min="0" />
                            </div>
                            <div class="input-group">
                                <label>Gender *</label>
                                <select name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Status *</label>
                                <select name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="edit-medical" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Medical History *</label>
                                <textarea name="medical_history" required rows="3" class="w-full"></textarea>
                            </div>
                            <div class="input-group">
                                <label>Waiting Time (months) *</label>
                                <input type="number" name="waiting_time" required />
                            </div>
                            <div class="input-group">
                                <label>Organ Needed *</label>
                                <input type="text" name="organ_needed" required />
                            </div>
                            <div class="input-group">
                                <label>Donation Preferences</label>
                                <input type="text" name="donation_preferences" />
                            </div>
                        </div>
                    </div>

                    <div id="edit-contact" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label>Email Address *</label>
                                <input type="email" name="contact_information" required />
                            </div>
                            <div class="input-group">
                                <label>Contact Number *</label>
                                <input type="text" name="contact_number" required />
                            </div>
                            <div class="input-group">
                                <label>Encoded By *</label>
                                <input type="text" name="encoded_by" value="{{ Auth::user()->name }}" required readonly />
                            </div>
                            <div class="input-group">
                                <label>Encoded Date *</label>
                                <input type="date" name="encoded_date" value="{{ date('Y-m-d') }}" required readonly />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="form-actions">
                <button type="button" class="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="submit-btn" id="updateRecipientBtn">Update</button>
            </div>
        </div>
    </div>
</div> 