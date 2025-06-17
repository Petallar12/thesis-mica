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
                            <tr class="border-b">
                                <td class="px-4 py-2 text-center">{{ $organ->organ_needed }}</td>
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
        });
    </script>
</x-app-layout> 