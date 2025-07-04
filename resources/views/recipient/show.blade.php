<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    .tab-content { margin-top: 1.5rem; }
    .nav-tabs .nav-link.active { background: #9c0f3f; color: #fff; }
    .nav-tabs .nav-link { color: #9c0f3f; font-weight: 500; }
    .th_modal { width: 40%; }
</style>

<ul class="nav nav-tabs" id="recipientTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="kin-tab" data-bs-toggle="tab" data-bs-target="#kin" type="button" role="tab">Next of Kin</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="medical-tab" data-bs-toggle="tab" data-bs-target="#medical" type="button" role="tab">Medical Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="transplant-tab" data-bs-toggle="tab" data-bs-target="#transplant" type="button" role="tab">Transplant Info</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="scheduling-tab" data-bs-toggle="tab" data-bs-target="#scheduling" type="button" role="tab">Scheduling</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Contact Information</button>
    </li>
</ul>
<div class="tab-content" id="recipientTabsContent">
    <div class="tab-pane fade show active" id="personal" role="tabpanel">
<table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">First Name</th><td class="td_modal">{{ $recipient->first_name }}</td></tr>
                <tr><th class="th_modal">Middle Name</th><td class="td_modal">{{ $recipient->middle_name }}</td></tr>
                <tr><th class="th_modal">Last Name</th><td class="td_modal">{{ $recipient->last_name }}</td></tr>
                <tr><th class="th_modal">Government ID Number</th><td class="td_modal">{{ $recipient->goverment_id_number }}</td></tr>
                <tr><th class="th_modal">Blood Type</th><td class="td_modal">{{ $recipient->blood_type }}</td></tr>
                <tr><th class="th_modal">Age</th><td class="td_modal">{{ $recipient->age }}</td></tr>
                <tr><th class="th_modal">Gender</th><td class="td_modal">{{ $recipient->gender }}</td></tr>
                <tr><th class="th_modal">Birthday</th><td class="td_modal">{{ $recipient->birthday ? date('M d, Y', strtotime($recipient->birthday)) : 'N/A' }}</td></tr>
                <tr><th class="th_modal">Nationality</th><td class="td_modal">{{ $recipient->nationality ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Address</th><td class="td_modal">{{ $recipient->address ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Status</th><td class="td_modal">{{ $recipient->status }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="kin" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Next of Kin Full Name</th><td class="td_modal">{{ $recipient->kin_fullname ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Relationship to Recipient</th><td class="td_modal">{{ $recipient->relationship_to_recipient ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Kin Contact Number</th><td class="td_modal">{{ $recipient->kin_contact_number ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Kin Email</th><td class="td_modal">{{ $recipient->kin_email ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Kin Address</th><td class="td_modal">{{ $recipient->kin_address ?? 'N/A' }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="medical" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Medical History</th><td class="td_modal">{{ $recipient->medical_history }}</td></tr>
                <tr><th class="th_modal">HLA Typing</th><td class="td_modal">{{ $recipient->hla_typing ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Medical Condition</th><td class="td_modal">{{ $recipient->medical_condition ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Medical Urgency Score</th><td class="td_modal">{{ $recipient->medical_urgency_score ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Date Listed</th><td class="td_modal">{{ $recipient->date_listed ? date('M d, Y', strtotime($recipient->date_listed)) : 'N/A' }}</td></tr>
                <tr><th class="th_modal">Immunologic Sensitization</th><td class="td_modal">{{ $recipient->immunologic_sensitization ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Priority Score</th><td class="td_modal">{{ $recipient->priority_score ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Waiting Time</th><td class="td_modal">{{ $recipient->waiting_time }} months</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="transplant" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Organ Needed</th><td class="td_modal">{{ $recipient->organ_needed }}</td></tr>
                <tr><th class="th_modal">Match Attempts</th><td class="td_modal">{{ $recipient->match_attempts ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Transplant Status</th><td class="td_modal">{{ $recipient->transplant_status ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Donation Preferences</th><td class="td_modal">{{ $recipient->donation_preferences ?? 'N/A' }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="scheduling" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Scheduled Transplant Date</th><td class="td_modal">{{ $recipient->scheduled_transplant_date ? date('M d, Y', strtotime($recipient->scheduled_transplant_date)) : 'N/A' }}</td></tr>
                <tr><th class="th_modal">Transplantation Time</th><td class="td_modal">{{ $recipient->transplantation_time ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Operating Room Availability</th><td class="td_modal">{{ $recipient->operating_room_availaility ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Transplant Surgeon</th><td class="td_modal">{{ $recipient->transplant_surgeon ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Surgical Team Availability</th><td class="td_modal">{{ $recipient->surgical_team_availability ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Hospital Location</th><td class="td_modal">{{ $recipient->hospital_location ?? 'N/A' }}</td></tr>
                <tr><th class="th_modal">Transport Arrangement</th><td class="td_modal">{{ $recipient->transport_arrangement ?? 'N/A' }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="th_modal">Email Address</th><td class="td_modal">{{ $recipient->contact_information }}</td></tr>
                <tr><th class="th_modal">Contact Number</th><td class="td_modal">{{ $recipient->contact_number }}</td></tr>
                <tr><th class="th_modal">Encoded By</th><td class="td_modal">{{ $recipient->encoded_by }}</td></tr>
                <tr><th class="th_modal">Encoded Date</th><td class="td_modal">{{ $recipient->encoded_date }}</td></tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 