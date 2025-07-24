<x-app-layout>
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/matching.css') }}" />
<style>
    .matching-td {
    font-size: 16px !important; /* Adjusted for readability */
    padding: 10px 15px !important;
    border: 1px white solid;
    width: 25%;
    text-align: center !important;
    vertical-align: middle !important; /* Center text vertically */
    margin-bottom: 0 !important; /* Remove margin at the bottom */
    }
</style>
    <div class="container py-4">
        <h2 class="font-semibold text-gray-700 mb-4">Edit Matching Points</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('matching.updateSettings') }}" method="POST">
            @csrf
                <div class="container-index">

                <table class="table table-striped nowrap" style="width:100%; border-radius: 5px;">
                    <thead>
                        <tr>
                            <th style="background-color: #9c0f3f; color: white; width: 65%;">Category For Matching Points</th>
                            <th style="background-color: #9c0f3f; color: white; width: 25%;">Point Values</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Waiting Time -->
                        <tr>
                            <td class="matching-td"><b>Waiting Time -></b> Less Than 12 Months</td>
                            <td class="matching-td"><input type="number" name="waiting_time_less_than_12" class="form-control" value="{{ $points->waiting_time_less_than_12 }}"></td>
                        </tr>
                        <tr>
                            <td class="matching-td" style="font-size:20px;"><b>Waiting Time -></b> 12 to 35 months</td>
                            <td class="matching-td"><input type="number" name="waiting_time_12_to_35" class="form-control" value="{{ $points->waiting_time_12_to_35 }}"></td>
                        </tr>
                        <tr>
                            <td class="matching-td"><b>Waiting Time -></b> More Than 36 Months</td>
                            <td class="matching-td"><input type="number" name="waiting_time_more_than_36" class="form-control" value="{{ $points->waiting_time_more_than_36 }}"></td>
                        </tr>

                        <!-- Age -->
                        <tr>
                            <td class="matching-td"><b>Age -></b> Less Than 18</td>
                            <td class="matching-td"><input type="number" name="age_less_than_18" class="form-control" value="{{ $points->age_less_than_18 }}"></td>
                        </tr>
                        <tr>
                            <td class="matching-td"><b>Age -></b> More Than 18</td>
                            <td class="matching-td"><input type="number" name="age_more_than_18" class="form-control" value="{{ $points->age_more_than_18 }}"></td>
                        </tr>

                        <!-- Blood Type -->
                        <tr>
                            <td class="matching-td"><b>Blood Type Compatibility</b></td>
                            <td class="matching-td"><input type="number" name="blood_type" class="form-control" value="{{ $points->blood_type }}"></td>
                        </tr>

                        <!-- Urgency -->
                        <tr>
                            <td class="matching-td"><b>Urgency Level -></b> Low</td>
                            <td class="matching-td"><input type="number" name="urgency_low" class="form-control" value="{{ $points->urgency_low }}"></td>
                        </tr>
                        <tr>
                            <td class="matching-td"><b>Urgency Level -></b> Medium</td>
                            <td class="matching-td"><input type="number" name="urgency_medium" class="form-control" value="{{ $points->urgency_medium }}"></td>
                        </tr>
                        <tr>
                            <td class="matching-td"><b>Urgency Level -></b> High</td>
                            <td class="matching-td"><input type="number" name="urgency_high" class="form-control" value="{{ $points->urgency_high }}"></td>
                        </tr>
                        <tr>
                            <td class="matching-td"><b>Urgency Level -></b> Critical</td>
                            <td class="matching-td"><input type="number" name="urgency_critical" class="form-control" value="{{ $points->urgency_critical }}"></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</x-app-layout>
