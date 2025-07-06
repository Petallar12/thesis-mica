<x-app-layout>
<div class="max-w-2xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="header-title font-semibold text-gray-700 mb-4">Edit Donor (Website)</h2>
    <form method="POST" action="{{ route('donor-card.update', $donor->id) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $donor->first_name }}" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $donor->last_name }}" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="contact_information" class="form-control" value="{{ $donor->contact_information }}" />
        </div>
        <div class="mb-3">
            <label class="form-label">Kin Full Name</label>
            <input type="text" name="kin_fullname" class="form-control" value="{{ $donor->kin_fullname }}" />
        </div>
        <div class="mb-3">
            <label class="form-label">Blood Type</label>
            <input type="text" name="blood_type" class="form-control" value="{{ $donor->blood_type }}" />
        </div>
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <input type="text" name="gender" class="form-control" value="{{ $donor->gender }}" />
        </div>
        <div class="mb-3">
            <label class="form-label">Organ Donated</label>
            <input type="text" name="organ_needed" class="form-control" value="{{ $donor->organ_needed }}" />
        </div>
        <div class="mb-3">
            <label class="form-label">Donor Status</label>
            <input type="text" name="donor_status" class="form-control" value="{{ $donor->donor_status }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('donor-card.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout> 