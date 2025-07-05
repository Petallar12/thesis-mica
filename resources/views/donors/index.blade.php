<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="header-title font-semibold text-gray-700">Donors List</h2>
            
            @if(auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Encoder')
            <button type="button" class="text-white px-4 py-2 rounded-md hover:bg-[#8a0d36]" style="background-color: #9c0f3f;" data-bs-toggle="modal" data-bs-target="#createDonorModal">
                <i class="fa-solid fa-plus"></i> Add Donor
            </button>
            @endif
        </div>

        <div class="container-index">
            <table id="donorsTable" class="table table-striped nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Kin Full Name</th>
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
                            Gender
                            {{-- <select class="gender-filter" id="gender-filter">
                                <option value="">Genders</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select> --}}
                        </th>
                        <th>Organ Donated</th>
                        <th>Donor Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donors as $donor)
                    <tr class="text-center">
                        <td>{{ $donor->id }}</td>
                        <td>{{ $donor->first_name }}</td>
                        <td>{{ $donor->last_name }}</td>
                        <td>{{ $donor->contact_information }}</td>
                        <td>{{ $donor->kin_fullname }}</td>

                        <td>{{ $donor->blood_type }}</td>
                        <td>{{ $donor->gender }}</td>
                        <td>{{ $donor->organ_needed }}</td>
                        <td>{{ $donor->status }}</td>
                        <td class="py-2 px-4 border-b flex gap-4 justify-center">
                            <a href="#" class="actionBtn show-donor" data-id="{{ $donor->id }}" title="Show Donor">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if(auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Encoder')
                            <a href="{{ route('donors.edit', $donor->id) }}" class="actionBtn" title="Edit Donor">
                                <i class="fa-solid fa-square-pen"></i>
                            </a>
                            <form class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="actionBtn delete-donor-btn" data-id="{{ $donor->id }}" title="Delete Donor">
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

    <!-- Modal for showing donor details -->
    <div class="modal fade" id="showDonorModal" tabindex="-1" aria-labelledby="showDonorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</span>
                <h2 class="modal-title" id="showDonorModalLabel">Donor Details</h2>
                
                <div class="tabs">
                    <button type="button" class="tab active" data-tab="personal">Personal Information</button>
                    <button type="button" class="tab" data-tab="medical">Medical Information</button>
                    <button type="button" class="tab" data-tab="contact">Contact Information</button>
                </div>

                <div class="modal-body" id="donorDetailsContent">
                    <p class="loading-text">Loading...</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the modals -->
    @include('components.modals.edit-donor-modal')
    @include('components.modals.create-donor-modal')

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    {{-- Bootstrap JS (for modal) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            var table = $('#donorsTable').DataTable({
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
            $(document).on('click', '.show-donor', function(e) {
                e.preventDefault();
                showDonorDetails($(this).data('id'));
            });

            // Handle edit button click
            $(document).on('click', '.actionBtn[title="Edit Donor"]', function(e) {
                e.preventDefault();
                const donorId = $(this).closest('tr').find('td:first').text();
                editDonorDetails(donorId);
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

            // Function to show donor details
            function showDonorDetails(donorId) {
                $('#donorDetailsContent').html('<p class="loading-text">Loading...</p>');
                const modal = new bootstrap.Modal(document.getElementById('showDonorModal'));
                modal.show();

                $.ajax({
                    url: '/donors/' + donorId,
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

                        $('#donorDetailsContent').empty()
                            .append(personalInfo)
                            .append(medicalInfo)
                            .append(contactInfo);

                        // Ensure first tab is active by default
                        $('.tab').first().click();
                    },
                    error: function() {
                        $('#donorDetailsContent').html('<p class="text-danger">Failed to load donor details.</p>');
                    }
                });
            }

            // Function to load and show donor edit form
            function editDonorDetails(donorId) {
                const modal = new bootstrap.Modal(document.getElementById('editDonorModal'));
                
                // Fetch donor data
                $.ajax({
                    url: `/donors/${donorId}/edit`,
                    type: 'GET',
                    success: function(donor) {
                        // Fill form with donor data
                        const form = $('#editDonorForm');
                        form.attr('action', `/donors/${donorId}`);
                        
                        // Fill all input fields
                        Object.keys(donor).forEach(key => {
                            const input = form.find(`[name="${key}"]`);
                            if (input.length) {
                                if (input.is('select')) {
                                    input.val(donor[key]);
                                } else {
                                    input.val(donor[key]);
                                }
                            }
                        });

                        modal.show();
                    },
                    error: function() {
                        alert('Failed to load donor details.');
                    }
                });
            }

            // Handle update button click
            $('#updateDonorBtn').on('click', function() {
                const form = $('#editDonorForm');
                const formData = new FormData(form[0]);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#editSuccessMessage').text('Donor updated successfully!').show();
                            setTimeout(() => {
                                bootstrap.Modal.getInstance(document.getElementById('editDonorModal')).hide();
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            const errorMessages = Object.values(errors).flat().join('\n');
                            $('#editSuccessMessage')
                                .text(errorMessages)
                                .show()
                                .css('background-color', '#f44336');
                        } else {
                            $('#editSuccessMessage')
                                .text('An error occurred while updating the donor.')
                                .show()
                                .css('background-color', '#f44336');
                        }
                    }
                });
            });

            // Handle save button click for create modal
            $('#saveDonorBtn').on('click', function() {
                const form = $('#createDonorForm');
                const formData = new FormData(form[0]);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#createSuccessMessage').text('Donor added successfully!').show();
                            setTimeout(() => {
                                bootstrap.Modal.getInstance(document.getElementById('createDonorModal')).hide();
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            const errorMessages = Object.values(errors).flat().join('\n');
                            $('#createSuccessMessage')
                                .text(errorMessages)
                                .show()
                                .css('background-color', '#f44336');
                        } else {
                            $('#createSuccessMessage')
                                .text('An error occurred while adding the donor.')
                                .show()
                                .css('background-color', '#f44336');
                        }
                    }
                });
            });

            // Helper function to categorize information
            function categorizeInfo(label) {
                const personalFields = [
                    'ID', 
                    'First Name', 
                    'Middle Name', 
                    'Last Name', 
                    'Age', 
                    'Donation Preferences',
                    'Government ID Number',
                    'Gender',
                    'Status',
                    'Encoded Date'
                ];
                
                const medicalFields = [
                    'Medical History',
                    'Blood Type',
                    'Organ Needed',
                    'Waiting Time'
                ];
                
                const contactFields = [
                    'Contact Information',
                    'Contact Number',
                    'Encoded By'
                ];
                
                if (personalFields.includes(label)) return 'personal';
                if (medicalFields.includes(label)) return 'medical';
                if (contactFields.includes(label)) return 'contact';
                return 'personal'; // default to personal if not found
            }

            // Handle delete button click
            $(document).on('click', '.delete-donor-btn', function(e) {
                e.preventDefault();
                const donorId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure you want to delete this donor? You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/donors/${donorId}`,
                            type: 'POST',
                            data: { _method: 'DELETE', _token: $('meta[name="csrf-token"]').attr('content') },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Donor has been deleted.',
                                        'success'
                                    ).then(() => location.reload());
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message || 'Failed to delete donor.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred during deletion. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
