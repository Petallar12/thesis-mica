<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    .tab-content { margin-top: 1.5rem; }
    .nav-tabs .nav-link.active { background: #9c0f3f; color: #fff; }
    .nav-tabs .nav-link { color: #9c0f3f; font-weight: 500; }
    .th_modal { width: 40%; }
</style>

<ul class="nav nav-tabs" id="donorTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="kin-tab" data-bs-toggle="tab" data-bs-target="#kin" type="button" role="tab">Kin Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="medical-tab" data-bs-toggle="tab" data-bs-target="#medical" type="button" role="tab">Medical Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="organ-tab" data-bs-toggle="tab" data-bs-target="#organ" type="button" role="tab">Organ-Specific Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="system-tab" data-bs-toggle="tab" data-bs-target="#system" type="button" role="tab">System Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#others" type="button" role="tab">Others</button>
    </li>
</ul>
<div class="tab-content" id="donorTabsContent">
    <div class="tab-pane fade show active" id="personal" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">ID</th><td class="td_modal">{{ $donor->id }}</td></tr>
                <tr><th class="th_modal">First Name</th><td class="td_modal">{{ $donor->first_name }}</td></tr>
                <tr><th class="th_modal">Middle Name</th><td class="td_modal">{{ $donor->middle_name }}</td></tr>
                <tr><th class="th_modal">Last Name</th><td class="td_modal">{{ $donor->last_name }}</td></tr>
                <tr><th class="th_modal">Gender</th><td class="td_modal">{{ $donor->gender }}</td></tr>
                <tr><th class="th_modal">Birthday</th><td class="td_modal">{{ $donor->birthday ? date('M d, Y', strtotime($donor->birthday)) : 'N/A' }}</td></tr>
                <tr><th class="th_modal">Age</th><td class="td_modal">{{ $donor->age }}</td></tr>
                <tr><th class="th_modal">Nationality</th><td class="td_modal">{{ $donor->nationality }}</td></tr>
                <tr><th class="th_modal">Contact Number</th><td class="td_modal">{{ $donor->contact_number }}</td></tr>
                <tr><th class="th_modal">Email Address</th><td class="td_modal">{{ $donor->contact_information }}</td></tr>
                <tr><th class="th_modal">Government ID Number</th><td class="td_modal">{{ $donor->goverment_id_number }}</td></tr>
                <tr><th class="th_modal">Address</th><td class="td_modal">{{ $donor->address }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="kin" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Kin Full Name</th><td class="td_modal">{{ $donor->kin_fullname }}</td></tr>
                <tr><th class="th_modal">Relationship to Donor</th><td class="td_modal">{{ $donor->relationship_to_donor }}</td></tr>
                <tr><th class="th_modal">Kin Contact Number</th><td class="td_modal">{{ $donor->kin_contact_number }}</td></tr>
                <tr><th class="th_modal">Kin Email</th><td class="td_modal">{{ $donor->kin_email }}</td></tr>
                <tr><th class="th_modal">Kin Address</th><td class="td_modal">{{ $donor->kin_address }}</td></tr>
                <tr><th class="th_modal">Kin Consent</th><td class="td_modal">{{ $donor->kin_consent }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="medical" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Blood Type</th><td class="td_modal">{{ $donor->blood_type }}</td></tr>
                <tr><th class="th_modal">Height</th><td class="td_modal">{{ $donor->height }}</td></tr>
                <tr><th class="th_modal">Weight</th><td class="td_modal">{{ $donor->weight }}</td></tr>
                <tr><th class="th_modal">Cause of Death</th><td class="td_modal">{{ $donor->cause_of_death }}</td></tr>
                <tr><th class="th_modal">Brain Death Confirmation</th><td class="td_modal">{{ $donor->brain_death_confirmation }}</td></tr>
                <tr><th class="th_modal">Medical History</th><td class="td_modal">{{ $donor->medical_history }}</td></tr>
                <tr><th class="th_modal">Communicable Diseases</th><td class="td_modal">{{ $donor->communicable_diseases }}</td></tr>
                <tr><th class="th_modal">Organ Viability Status</th><td class="td_modal">{{ $donor->organ_viability_status }}</td></tr>
                <tr><th class="th_modal">Donor Status</th><td class="td_modal">{{ $donor->donor_status }}</td></tr>
                <tr><th class="th_modal">Status</th><td class="td_modal">{{ $donor->status }}</td></tr>
                <tr><th class="th_modal">Consent Type</th><td class="td_modal">{{ $donor->consent_type }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="organ" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Organ Needed</th><td class="td_modal">{{ $donor->organ_needed }}</td></tr>
                <tr><th class="th_modal">Organ Size</th><td class="td_modal">{{ $donor->organ_size }}</td></tr>
                <tr><th class="th_modal">Organ Function</th><td class="td_modal">{{ $donor->ogran_function }}</td></tr>
                <tr><th class="th_modal">Retrieval Time</th><td class="td_modal">{{ $donor->retrieval_time }}</td></tr>
                <tr><th class="th_modal">Organ Preservation Status</th><td class="td_modal">{{ $donor->organ_preservation_status }}</td></tr>
                <tr><th class="th_modal">Condition of Organs</th><td class="td_modal">{{ $donor->condition_of_organs }}</td></tr>
                <tr><th class="th_modal">Organ Compatibility</th><td class="td_modal">{{ $donor->organ_compability }}</td></tr>
                <tr><th class="th_modal">Organ Recovery Team</th><td class="td_modal">{{ $donor->organ_recovery_team }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="system" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Donor Card Registration Date</th><td class="td_modal">{{ $donor->donor_card_registration_date }}</td></tr>
                <tr><th class="th_modal">Registration Method</th><td class="td_modal">{{ $donor->registration_method }}</td></tr>
                <tr><th class="th_modal">Notification Set to Family</th><td class="td_modal">{{ $donor->notification_set_to_family }}</td></tr>
                <tr><th class="th_modal">Donor Card QR Code</th><td class="td_modal">{{ $donor->donor_card_qr_code }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="others" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Donation Type</th><td class="td_modal">{{ $donor->donation_type }}</td></tr>
                <tr><th class="th_modal">Donation Purpose</th><td class="td_modal">{{ $donor->donation_purpose }}</td></tr>
                <tr><th class="th_modal">Condition for Donation</th><td class="td_modal">{{ $donor->condition_for_donation }}</td></tr>
                <tr><th class="th_modal">Signature</th><td class="td_modal">{{ $donor->signature }}</td></tr>
                <tr><th class="th_modal">Today's Date</th><td class="td_modal">{{ $donor->todays_date }}</td></tr>
                <tr><th class="th_modal">Waiting Time</th><td class="td_modal">{{ $donor->waiting_time }}</td></tr>
                <tr><th class="th_modal">Donation Preferences</th><td class="td_modal">{{ $donor->donation_preferences }}</td></tr>
                <tr><th class="th_modal">Encoded By</th><td class="td_modal">{{ $donor->encoded_by }}</td></tr>
                <tr><th class="th_modal">Encoded Date</th><td class="td_modal">{{ $donor->encoded_date }}</td></tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
