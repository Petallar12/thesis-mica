<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="header-title font-semibold text-gray-700">Donor-Recipient Matching</h2>
            <div class="text-muted">
                <small>Showing {{ count($matches) }} donor(s) with potential matches</small>
            </div>
        </div>

        @if(count($matches) > 0)
            <div class="row">
                @foreach($matches as $matchGroup)
                    @php $donor = $matchGroup['donor']; @endphp
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-white" style="background-color: #9c0f3f;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $matchGroup['organ'] }}</h5>
                                    <span class="badge bg-light text-dark fs-6">{{ $matchGroup['recipient_matches'][0]['matchScore'] }}/100</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-heart text-danger me-2"></i>Donor
                                </h6>
                                <div class="mb-2"><strong>Name:</strong> {{ $donor->first_name }} {{ $donor->last_name }}</div>
                                <div class="mb-2"><strong>Age:</strong> {{ $donor->age ?? 'N/A' }} years</div>
                                
                                <!-- Blood Type with color -->
                                <div class="mb-2">
                                    <strong>Blood Type:</strong> 
                                    <span class="badge bg-{{ $donor->blood_type === 'A+' ? 'danger' : ($donor->blood_type === 'B+' ? 'warning' : 'info') }}">
                                        {{ $donor->blood_type ?? 'N/A' }}
                                    </span>
                                </div>
                                
                                <!-- Donor Status with color -->
                                <div class="mb-2">
                                    <strong>Donor Status:</strong>
                                    <span class="badge bg-{{ $donor->donor_status === 'Alive' ? 'success' : ($donor->donor_status === 'Deceased' ? 'danger' : 'warning') }}">
                                        {{ $donor->donor_status ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ count($matchGroup['recipient_matches']) }} match(es)</small>
                                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modal{{ $donor->id }}">
                                    View Matches
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $donor->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $donor->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $donor->id }}">Matches for Donor: {{ $donor->first_name }} {{ $donor->last_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach($matchGroup['recipient_matches'] as $match)
                                        <div class="border-bottom mb-3 pb-3">
                                            <h6 class="text-success">Recipient: {{ $match['recipient']->first_name }} {{ $match['recipient']->last_name }}</h6>
                                            <ul class="list-unstyled">
                                                <li><strong>Age:</strong> {{ $match['recipient']->age ?? 'N/A' }} years</li>
                                                <li><strong>Blood Type:</strong> 
                                                    <span class="badge bg-{{ $match['recipient']->blood_type === 'A+' ? 'danger' : ($match['recipient']->blood_type === 'B+' ? 'warning' : 'info') }}">
                                                        {{ $match['recipient']->blood_type ?? 'N/A' }}
                                                    </span>
                                                </li>
                                                <li><strong>Waiting Time:</strong> {{ $match['recipient']->waiting_time ?? 'N/A' }} Months</li>
                                                <li><strong>Urgency:</strong> 
                                                    <span class="badge bg-{{ $match['recipient']->medical_urgency_score === 'Critical' ? 'danger' : ($match['recipient']->medical_urgency_score === 'High' ? 'warning' : 'secondary') }}">
                                                        {{ $match['recipient']->medical_urgency_score ?? 'N/A' }}
                                                    </span>
                                                </li>
                                            </ul>

                                            <!-- Displaying the total match score with color -->
                                            @php
                                                $scoreClass = 'bg-secondary';
                                                if ($match['matchScore'] >= 90) {
                                                    $scoreClass = 'bg-success';
                                                } elseif ($match['matchScore'] >= 70) {
                                                    $scoreClass = 'bg-warning';
                                                } else {
                                                    $scoreClass = 'bg-danger';
                                                }
                                            @endphp
                                            <strong>Total Match Score:</strong> 
                                            <span class="badge {{ $scoreClass }}">{{ $match['matchScore'] }}/100</span>

                                            <h6 class="mt-2">Compatibility Checks:</h6>
                                            <ul class="list-unstyled small">
                                                <li><strong>Waiting Time:</strong> {{ $match['pointsBreakdown']['waiting_time']['desc'] ?? 'N/A' }} <span class="badge bg-secondary ms-2">{{ $match['pointsBreakdown']['waiting_time']['points'] }}/{{ $match['pointsBreakdown']['waiting_time']['max'] }} pts</span></li>
                                                <li><strong>Age:</strong> {{ $match['pointsBreakdown']['age']['desc'] ?? 'N/A' }} <span class="badge bg-secondary ms-2">{{ $match['pointsBreakdown']['age']['points'] }}/{{ $match['pointsBreakdown']['age']['max'] }} pts</span></li>
                                                <li><strong>Blood Type:</strong> {{ $match['pointsBreakdown']['blood_type']['desc'] ?? 'N/A' }} <span class="badge bg-secondary ms-2">{{ $match['pointsBreakdown']['blood_type']['points'] }}/{{ $match['pointsBreakdown']['blood_type']['max'] }} pts</span></li>
                                                <li><strong>Urgency:</strong> {{ $match['pointsBreakdown']['urgency']['desc'] ?? 'N/A' }} <span class="badge bg-secondary ms-2">{{ $match['pointsBreakdown']['urgency']['points'] }}/{{ $match['pointsBreakdown']['urgency']['max'] }} pts</span></li>
                                            </ul>
                                            <div class="small">
                                                @foreach($match['compatibility']['checks'] as $check)
                                                    <div><i class="fas fa-check-circle text-success me-1"></i>{{ $check }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <h4 class="text-muted mb-3">No Compatible Matches Found</h4>
                <p class="text-muted">There are currently no compatible donor-recipient pairs based on the matching criteria.</p>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS and Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
