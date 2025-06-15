<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="header-title font-semibold text-gray-700">Recipients List</h2>
            @if(auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Encoder')
            <button type="button" class="text-white px-4 py-2 rounded-md hover:bg-[#8a0d36] shadow-none" style="background-color: #9c0f3f;" data-bs-toggle="modal" data-bs-target="#createRecipientModal">
                <i class="fa-solid fa-plus"></i> Add Recipient
            </button>
            @endif
        </div>

        <div class="container-index">
            <table id="recipientsTable" class="table table-striped nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>
                            <select class="blood-type-filter" id="blood-type-filter">
                                <option value="">Blood type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </th>
                        <th>
                            <select class="gender-filter" id="gender-filter">
                                <option value="">Genders</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipients as $recipient)
                    <tr class="text-center">
                        <td>{{ $recipient->id }}</td>
                        <td>{{ $recipient->first_name }}</td>
                        <td>{{ $recipient->last_name }}</td>
                        <td>{{ $recipient->age }}</td>
                        <td>{{ $recipient->blood_type }}</td>
                        <td>{{ $recipient->gender }}</td>
                        <td>{{ $recipient->status }}</td>
                        <td class="py-2 px-4 border-b flex gap-4 justify-center">
                            <a href="#" class="actionBtn show-recipient" data-id="{{ $recipient->id }}" title="Show Recipient">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if(auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Encoder')
                            <a href="{{ route('recipients.edit', $recipient->id) }}" class="actionBtn" title="Edit Recipient">
                                <i class="fa-solid fa-square-pen"></i>
                            </a>
                            <form action="{{ route('recipients.destroy', $recipient->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="actionBtn" title="Delete Recipient">
                                    <i class="fa-solid fa-circle-minus"></i>
                                </button>
                                
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for showing recipient details -->
    <div class="modal fade" id="showRecipientModal" tabindex="-1" aria-labelledby="showRecipientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</span>
                <h2 class="modal-title" id="showRecipientModalLabel">Recipient Details</h2>
                
                <div class="tabs">
                    <button type="button" class="tab active" data-tab="personal">Personal Information</button>
                    <button type="button" class="tab" data-tab="medical">Medical Information</button>
                    <button type="button" class="tab" data-tab="contact">Contact Information</button>
                </div>

                <div class="modal-body" id="recipientDetailsContent">
                    <p class="loading-text">Loading...</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the modals -->
    @include('components.modals.edit-recipient-modal')
    @include('components.modals.create-recipient-modal')

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    {{-- Bootstrap JS (for modal) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#recipientsTable').DataTable({
                paging: true,
                searching: true,
                ordering: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                dom: '<"top"lf>rt<"bottom"ip><"clear">',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records..."
                }
            });

            // Filters
            $('#blood-type-filter').on('change', function() {
                table.column(4).search(this.value).draw();
            });
            $('#gender-filter').on('change', function() {
                table.column(5).search(this.value).draw();
            });

            // Handle show button click
            $('.show-recipient').on('click', function(e) {
                e.preventDefault();
                showRecipientDetails($(this).data('id'));
            });

            // Handle edit button click
            $('.actionBtn[title="Edit Recipient"]').on('click', function(e) {
                e.preventDefault();
                const recipientId = $(this).closest('tr').find('td:first').text();
                editRecipientDetails(recipientId);
            });

            // Handle tab switching in both modals
            $(document).on('click', '.tab', function() {
                const modalId = $(this).closest('.modal').attr('id');
                $(`#${modalId} .tab`).removeClass('active');
                $(this).addClass('active');
                
                const tabId = $(this).data('tab');
                $(`#${modalId} .tab-content`).removeClass('active');
                $(`#${tabId}`).addClass('active');
            });

            // Function to show recipient details
            function showRecipientDetails(recipientId) {
                $('#recipientDetailsContent').html('<p class="loading-text">Loading...</p>');
                const modal = new bootstrap.Modal(document.getElementById('showRecipientModal'));
                modal.show();

                $.ajax({
                    url: '/recipients/' + recipientId,
                    type: 'GET',
                    success: function(data) {
                        const details = $(data);
                        const personalInfo = $('<div id="personal" class="tab-content active"></div>');
                        const medicalInfo = $('<div id="medical" class="tab-content"></div>');
                        const contactInfo = $('<div id="contact" class="tab-content"></div>');
                        
                        // Sort details into appropriate tabs
                        details.find('tr').each(function() {
                            const row = $(this);
                            const category = categorizeInfo(row.find('th').text());
                            row.find('th').addClass('detail-label');
                            row.find('td').addClass('detail-value');
                            
                            if (category === 'medical') {
                                medicalInfo.append(row);
                            } else if (category === 'contact') {
                                contactInfo.append(row);
                            } else {
                                personalInfo.append(row);
                            }
                        });

                        $('#recipientDetailsContent').empty()
                            .append(personalInfo)
                            .append(medicalInfo)
                            .append(contactInfo);

                        // Ensure first tab is active by default
                        $('.tab').first().click();
                    },
                    error: function() {
                        $('#recipientDetailsContent').html('<p class="text-danger">Failed to load recipient details.</p>');
                    }
                });
            }

            // Function to load and show recipient edit form
            function editRecipientDetails(recipientId) {
                const modal = new bootstrap.Modal(document.getElementById('editRecipientModal'));
                
                // Fetch recipient data
                $.ajax({
                    url: `/recipients/${recipientId}/edit`,
                    type: 'GET',
                    success: function(recipient) {
                        // Fill form with recipient data
                        const form = $('#editRecipientForm');
                        form.attr('action', `/recipients/${recipientId}`);
                        
                        // Fill all input fields
                        Object.keys(recipient).forEach(key => {
                            const input = form.find(`[name="${key}"]`);
                            if (input.length) {
                                if (input.is('select')) {
                                    input.find(`option[value="${recipient[key]}"]`).prop('selected', true);
                                } else {
                                    input.val(recipient[key]);
                                }
                            }
                        });

                        modal.show();
                    },
                    error: function() {
                        alert('Failed to load recipient details.');
                    }
                });
            }

            // Handle update button click
            $('#updateRecipientBtn').on('click', function() {
                const form = $('#editRecipientForm');
                const formData = new FormData(form[0]);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Failed to update recipient.');
                        }
                    },
                    error: function() {
                        alert('Failed to update recipient.');
                    }
                });
            });

            // Handle save button click
            $('#saveRecipientBtn').on('click', function() {
                const form = $('#createRecipientForm');
                const formData = new FormData(form[0]);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Failed to create recipient.');
                        }
                    },
                    error: function() {
                        alert('Failed to create recipient.');
                    }
                });
            });

            // Helper function to categorize information
            function categorizeInfo(label) {
                const medicalFields = ['Medical History', 'Waiting Time', 'Organ Needed', 'Donation Preferences'];
                const contactFields = ['Email', 'Contact', 'Encoded'];
                
                if (medicalFields.some(field => label.includes(field))) {
                    return 'medical';
                } else if (contactFields.some(field => label.includes(field))) {
                    return 'contact';
                }
                return 'personal';
            }
        });
    </script>
</x-app-layout> 