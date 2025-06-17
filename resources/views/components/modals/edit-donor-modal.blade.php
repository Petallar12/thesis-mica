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
                <button type="button" class="tab" data-tab="edit-medical">Medical Information</button>
                <button type="button" class="tab" data-tab="edit-contact">Contact Information</button>
            </div>

            <div class="modal-body">
                <div id="editSuccessMessage" class="success-message"></div>
                <form id="editDonorForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div id="edit-personal" class="tab-content active">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First Name *</label>
                                <input type="text" name="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" name="middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Name *</label>
                                <input type="text" name="last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Government ID Number *</label>
                                <input type="text" name="goverment_id_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Blood Type *</label>
                                <select name="blood_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-700 font-normal" >
                                    <option value="O+" class="text-gray-700 font-normal">O+</option>
                                    <option value="O-" class="text-gray-700 font-normal">O-</option>
                                    <option value="A+" class="text-gray-700 font-normal">A+</option>
                                    <option value="A-" class="text-gray-700 font-normal">A-</option>
                                    <option value="B+" class="text-gray-700 font-normal">B+</option>
                                    <option value="B-" class="text-gray-700 font-normal">B-</option>
                                    <option value="AB+" class="text-gray-700 font-normal">AB+</option>
                                    <option value="AB-" class="text-gray-700 font-normal">AB-</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Age *</label>
                                <input type="number" name="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  min="0" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gender *</label>
                                <select name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-700 font-normal" >
                                    <option value="Male" class="text-gray-700 font-normal">Male</option>
                                    <option value="Female" class="text-gray-700 font-normal">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-700 font-normal" >
                                    <option value="Active" class="text-gray-700 font-normal">Active</option>
                                    <option value="Inactive" class="text-gray-700 font-normal">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="edit-medical" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Medical History *</label>
                                <textarea name="medical_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  rows="3"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Waiting Time (months) *</label>
                                <input type="text" name="waiting_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Organ Donated *</label>
                                <input type="text" name="organ_needed" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Donation Preferences *</label>
                                <input type="text" name="donation_preferences" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                        </div>
                    </div>

                    <div id="edit-contact" class="tab-content">
                        <div class="form-group grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Address *</label>
                                <input type="email" name="contact_information" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number *</label>
                                <input type="text" name="contact_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"  />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Encoded By</label>
                                <input type="text" name="encoded_by" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-700 font-normal" value="{{ Auth::user()->name }}" readonly />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Encoded Date</label>
                                <input type="date" name="encoded_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-700 font-normal" value="{{ date('Y-m-d') }}" readonly />
                            </div>
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