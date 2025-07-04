<table class="table table-bordered">
    <tbody>
        <!-- Personal Information -->
        <tr>
            <th class="th_modal">First Name</th>
            <td class="th_modal">{{ $recipient->first_name }}</td>
        </tr>
        <tr>
            <th class="th_modal">Middle Name</th>
            <td class="th_modal">{{ $recipient->middle_name }}</td>
        </tr>
        <tr>
            <th class="th_modal">Last Name</th>
            <td class="th_modal">{{ $recipient->last_name }}</td>
        </tr>
        <tr>
            <th class="th_modal">Government ID Number</th>
            <td class="th_modal">{{ $recipient->goverment_id_number }}</td>
        </tr>
        <tr>
            <th class="th_modal">Blood Type</th>
            <td class="th_modal">{{ $recipient->blood_type }}</td>
        </tr>
        <tr>
            <th class="th_modal">Age</th>
            <td class="th_modal">{{ $recipient->age }}</td>
        </tr>
        <tr>
            <th class="th_modal">Gender</th>
            <td class="th_modal">{{ $recipient->gender }}</td>
        </tr>
        <tr>
            <th class="th_modal">Birthday</th>
            <td class="th_modal">{{ $recipient->birthday ? date('M d, Y', strtotime($recipient->birthday)) : 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Nationality</th>
            <td class="th_modal">{{ $recipient->nationality ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Address</th>
            <td class="th_modal">{{ $recipient->address ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Status</th>
            <td class="th_modal">{{ $recipient->status }}</td>
        </tr>

        <!-- Next of Kin Information -->
        <tr>
            <th class="th_modal">Next of Kin Full Name</th>
            <td class="th_modal">{{ $recipient->kin_fullname ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Relationship to Recipient</th>
            <td class="th_modal">{{ $recipient->relationship_to_recipient ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Kin Contact Number</th>
            <td class="th_modal">{{ $recipient->kin_contact_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Kin Email</th>
            <td class="th_modal">{{ $recipient->kin_email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Kin Address</th>
            <td class="th_modal">{{ $recipient->kin_address ?? 'N/A' }}</td>
        </tr>

        <!-- Medical Information -->
        <tr>
            <th class="th_modal">Medical History</th>
            <td class="th_modal">{{ $recipient->medical_history }}</td>
        </tr>
        <tr>
            <th class="th_modal">HLA Typing</th>
            <td class="th_modal">{{ $recipient->hla_typing ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Medical Condition</th>
            <td class="th_modal">{{ $recipient->medical_condition ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Medical Urgency Score</th>
            <td class="th_modal">{{ $recipient->medical_urgency_score ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Date Listed</th>
            <td class="th_modal">{{ $recipient->date_listed ? date('M d, Y', strtotime($recipient->date_listed)) : 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Immunologic Sensitization</th>
            <td class="th_modal">{{ $recipient->immunologic_sensitization ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Priority Score</th>
            <td class="th_modal">{{ $recipient->priority_score ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Waiting Time</th>
            <td class="th_modal">{{ $recipient->waiting_time }} months</td>
        </tr>

        <!-- Transplant Information -->
        <tr>
            <th class="th_modal">Organ Needed</th>
            <td class="th_modal">{{ $recipient->organ_needed }}</td>
        </tr>
        <tr>
            <th class="th_modal">Match Attempts</th>
            <td class="th_modal">{{ $recipient->match_attempts ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Transplant Status</th>
            <td class="th_modal">{{ $recipient->transplant_status ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Donation Preferences</th>
            <td class="th_modal">{{ $recipient->donation_preferences ?? 'N/A' }}</td>
        </tr>

        <!-- Transplant Scheduling -->
        <tr>
            <th class="th_modal">Scheduled Transplant Date</th>
            <td class="th_modal">{{ $recipient->scheduled_transplant_date ? date('M d, Y', strtotime($recipient->scheduled_transplant_date)) : 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Transplantation Time</th>
            <td class="th_modal">{{ $recipient->transplantation_time ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Operating Room Availability</th>
            <td class="th_modal">{{ $recipient->operating_room_availaility ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Transplant Surgeon</th>
            <td class="th_modal">{{ $recipient->transplant_surgeon ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Surgical Team Availability</th>
            <td class="th_modal">{{ $recipient->surgical_team_availability ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Hospital Location</th>
            <td class="th_modal">{{ $recipient->hospital_location ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="th_modal">Transport Arrangement</th>
            <td class="th_modal">{{ $recipient->transport_arrangement ?? 'N/A' }}</td>
        </tr>

        <!-- Contact Information -->
        <tr>
            <th class="th_modal">Email Address</th>
            <td class="th_modal">{{ $recipient->contact_information }}</td>
        </tr>
        <tr>
            <th class="th_modal">Contact Number</th>
            <td class="th_modal">{{ $recipient->contact_number }}</td>
        </tr>
        <tr>
            <th class="th_modal">Encoded By</th>
            <td class="th_modal">{{ $recipient->encoded_by }}</td>
        </tr>
        <tr>
            <th class="th_modal">Encoded Date</th>
            <td class="th_modal">{{ $recipient->encoded_date }}</td>
        </tr>
    </tbody>
</table> 