<x-app-layout>


    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="header-title font-semibold text-gray-700 mb-6">Dashboard</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                
                <!-- Card 1 -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">REGISTRATION</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalRegistration }}</p>
                        <p class="text-gray-500 mt-2">TOTAL REGISTRATION</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">TOTAL RECIPIENTS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalRecipients }}</p>
                        <p class="text-gray-500 mt-2">TOTAL RECIPIENTS</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">TOTAL DONORS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalDonors }}</p>
                        <p class="text-gray-500 mt-2">TOTAL DONORS</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">INACTIVE DONORS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalInactiveDonors }}</p>
                        <p class="text-gray-500 mt-2">INACTIVE DONORS</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">INACTIVE RECIPIENTS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalInactiveRecipients }}</p>
                        <p class="text-gray-500 mt-2">INACTIVE RECIPIENTS</p>
                    </div>
                </div>



                <!-- Card 6: Total Active Donors -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">ACTIVE DONORS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalActiveDonors }}</p>
                        <p class="text-gray-500 mt-2">ACTIVE DONORS</p>
                    </div>
                </div>

                <!-- Card 7: Total Active Recipients -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">ACTIVE RECIPIENTS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalActiveRecipients }}</p>
                        <p class="text-gray-500 mt-2">ACTIVE RECIPIENTS</p>
                    </div>
                </div>

                <!-- Card 8: Total Active Recipients -->
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="dashboard-card-header">TOTAL USERS</div>
                    <div class="p-6">
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                        <p class="text-gray-500 mt-2">TOTAL USERS</p>
                    </div>
                </div>

            </div>
            
            <div class="mt-8">
                @include('dashboard.total_users_graph')
            </div>

        </div>
    </div>
</x-app-layout>
