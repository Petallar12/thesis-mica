<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Donor-Recipient Matching</h2>
            <div class="text-muted">
                <small>Showing {{ count($matches) }} potential matches</small>
            </div>
        </div>

        @if(count($matches) > 0)
            <div class="row">
                @foreach($matches as $match)
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $match['organ'] }}</h5>
                                    <span class="badge bg-light text-dark fs-6">{{ $match['matchScore'] }}/100</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Donor Information -->
                                    <div class="col-md-6">
                                        <h6 class="text-primary mb-3">
                                            <i class="fas fa-heart text-danger me-2"></i>Donor
                                        </h6>
                                        <div class="mb-2">
                                            <strong>Name:</strong> {{ $match['donor']->first_name }} {{ $match['donor']->last_name }}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Age:</strong> {{ $match['donor']->age ?? 'N/A' }} years
                                        </div>
                                        <div class="mb-2">
                                            <strong>Blood Type:</strong> 
                                            <span class="badge bg-info">{{ $match['donor']->blood_type ?? 'N/A' }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Height:</strong> {{ $match['donor']->height ?? 'N/A' }} cm
                                        </div>
                                        <div class="mb-2">
                                            <strong>Status:</strong> 
                                            <span class="badge bg-{{ $match['donor']->donor_status === 'Available' ? 'success' : 'warning' }}">
                                                {{ $match['donor']->donor_status ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Recipient Information -->
                                    <div class="col-md-6">
                                        <h6 class="text-success mb-3">
                                            <i class="fas fa-user-injured text-success me-2"></i>Recipient
                                        </h6>
                                        <div class="mb-2">
                                            <strong>Name:</strong> {{ $match['recipient']->first_name }} {{ $match['recipient']->last_name }}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Age:</strong> {{ $match['recipient']->age ?? 'N/A' }} years
                                        </div>
                                        <div class="mb-2">
                                            <strong>Blood Type:</strong> 
                                            <span class="badge bg-info">{{ $match['recipient']->blood_type ?? 'N/A' }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Height:</strong> {{ $match['recipient']->height ?? 'N/A' }} cm
                                        </div>
                                        <div class="mb-2">
                                            <strong>Urgency:</strong> 
                                            <span class="badge bg-{{ $match['recipient']->medical_urgency_score >= 8 ? 'danger' : ($match['recipient']->medical_urgency_score >= 6 ? 'warning' : 'secondary') }}">
                                                {{ $match['recipient']->medical_urgency_score ?? 'N/A' }}/10
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Compatibility Details -->
                                <div class="mt-3">
                                    <h6 class="text-muted mb-2">Compatibility Checks:</h6>
                                    <div class="small">
                                        @foreach($match['compatibility']['checks'] as $check)
                                            <div class="mb-1">
                                                <i class="fas fa-check-circle text-success me-1"></i>
                                                {{ $check }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        Match Score: {{ $match['matchScore'] }}/100
                                    </div>
                                    <div>
                                        <a href="{{ route('donors.show', $match['donor']->id) }}" 
                                           class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-eye me-1"></i>View Donor
                                        </a>
                                        <a href="{{ route('recipients.show', $match['recipient']->id) }}" 
                                           class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-eye me-1"></i>View Recipient
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-search fa-3x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">No Compatible Matches Found</h4>
                <p class="text-muted mb-4">
                    There are currently no compatible donor-recipient pairs based on the matching criteria.
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Matching Criteria:</h6>
                                <ul class="list-unstyled mb-0">
                                    <li><i class="fas fa-check text-success me-2"></i>Same organ type needed/available</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Blood type compatibility</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Donor status must be "Available" or "Ready"</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Recipient status must be "Waiting" or "Listed"</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Age and size compatibility</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistics Section -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-primary">{{ $donors->count() }}</h3>
                        <p class="text-muted mb-0">Total Donors</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-success">{{ $recipients->count() }}</h3>
                        <p class="text-muted mb-0">Total Recipients</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-info">{{ count($matches) }}</h3>
                        <p class="text-muted mb-0">Potential Matches</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout> 