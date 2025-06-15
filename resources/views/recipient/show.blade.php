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
            <th class="th_modal">Status</th>
            <td class="th_modal">{{ $recipient->status }}</td>
        </tr>

        <!-- Medical Information -->
        <tr>
            <th class="th_modal">Medical History</th>
            <td class="th_modal">{{ $recipient->medical_history }}</td>
        </tr>
        <tr>
            <th class="th_modal">Waiting Time</th>
            <td class="th_modal">{{ $recipient->waiting_time }} months</td>
        </tr>
        <tr>
            <th class="th_modal">Organ Needed</th>
            <td class="th_modal">{{ $recipient->organ_needed }}</td>
        </tr>
        <tr>
            <th class="th_modal">Donation Preferences</th>
            <td class="th_modal">{{ $recipient->donation_preferences }}</td>
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