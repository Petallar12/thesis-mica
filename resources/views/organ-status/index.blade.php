<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="header-title font-semibold text-gray-700">Organs Availability</h2>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table id="organsTable" class="table table-striped nowrap" style="width: 100%">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Organ Type</th>
                                <th class="px-4 py-2">Available Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($availableOrgans as $organ)
                            <tr class="border-b organ-row" data-organ-type="{{ $organ->organ_needed }}">
                                <td class="px-4 py-2 text-center text-black font-bold cursor-pointer">{{ $organ->organ_needed }}</td>
                                <td class="px-4 py-2 text-center">{{ $organ->total_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Organ Details Modal -->
    <div class="modal fade" id="organDetailsModal" tabindex="-1" aria-labelledby="organDetailsModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="organDetailsModalLabel">Organ Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="organDetailsContent">
                        <p class="text-center">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-backdrop {
            background: transparent !important;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#organsTable').DataTable({
                paging: false,
                searching: true,
                ordering: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                dom: '<"top"lf>rt<"bottom"ip><"clear">',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search organs..."
                }
            });

            // Organ row click handler
            $(document).on('click', '.organ-row', function() {
                var organType = $(this).data('organ-type');
                $('#organDetailsModalLabel').text('Organ Details: ' + organType);
                $('#organDetailsContent').html('<p class="text-center">Loading...</p>');
                var modal = new bootstrap.Modal(document.getElementById('organDetailsModal'));
                modal.show();
                $.ajax({
                    url: '{{ route('organ-status.details') }}',
                    type: 'POST',
                    data: {
                        organ_type: organType,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            $('#organDetailsContent').html('<p class="text-center">No details found for this organ type.</p>');
                            return;
                        }
                        var html = '<table class="table table-bordered"><thead><tr><th>Organ Size</th><th>Blood Type</th><th>Organ Status</th><th>Brain Death Confirmation</th></tr></thead><tbody>';
                        data.forEach(function(row) {
                            html += '<tr>' +
                                '<td>' + (row.organ_size || 'N/A') + '</td>' +
                                '<td>' + (row.blood_type || 'N/A') + '</td>' +
                                '<td>' + (row.organ_viability_status || 'N/A') + '</td>' +
                                '<td>' + (row.brain_death_confirmation || 'N/A') + '</td>' +
                                '</tr>';
                        });
                        html += '</tbody></table>';
                        $('#organDetailsContent').html(html);
                    },
                    error: function() {
                        $('#organDetailsContent').html('<p class="text-danger text-center">Failed to load organ details.</p>');
                    }
                });
            });
        });
    </script>
</x-app-layout> 