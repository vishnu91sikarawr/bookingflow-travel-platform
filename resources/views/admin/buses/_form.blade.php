@csrf

<div class="card">

    <div class="card-body">

        @if($errors->any())

            <div class="alert alert-danger">

                <h5 class="mb-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    Please fix the following errors:
                </h5>

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

       <div class="row">

    {{-- Bus Operator --}}
    <div class="col-md-6 mb-3">
        <label for="bus_operator_id" class="form-label">
            Bus Operator <span class="text-danger">*</span>
        </label>

        <select name="bus_operator_id" id="bus_operator_id"
            class="form-control @error('bus_operator_id') is-invalid @enderror">

            <option value="">Select Bus Operator</option>

            @foreach ($busOperators as $operator)
                <option value="{{ $operator->id }}"
                    {{ old('bus_operator_id', $bus->bus_operator_id ?? '') == $operator->id ? 'selected' : '' }}>
                    {{ $operator->name }}
                </option>
            @endforeach

        </select>

        @error('bus_operator_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Bus Name --}}
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">
            Bus Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $bus->name ?? '') }}"
            placeholder="Enter Bus Name">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    {{-- Bus Number --}}
    <div class="col-md-6 mb-3">
        <label for="bus_number" class="form-label">
            Bus Number <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="bus_number"
            id="bus_number"
            class="form-control @error('bus_number') is-invalid @enderror"
            value="{{ old('bus_number', $bus->bus_number ?? '') }}"
            placeholder="e.g. RJ14AB1234">

        @error('bus_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Registration Number --}}
    <div class="col-md-6 mb-3">
        <label for="registration_number" class="form-label">
            Registration Number
        </label>

        <input
            type="text"
            name="registration_number"
            id="registration_number"
            class="form-control @error('registration_number') is-invalid @enderror"
            value="{{ old('registration_number', $bus->registration_number ?? '') }}"
            placeholder="Vehicle Registration Number">

        @error('registration_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    {{-- Bus Type --}}
    <div class="col-md-6 mb-3">
        <label for="bus_type" class="form-label">
            Bus Type <span class="text-danger">*</span>
        </label>

        <select
            name="bus_type"
            id="bus_type"
            class="form-control @error('bus_type') is-invalid @enderror">

            <option value="">Select Bus Type</option>

            @foreach (['AC','Non AC','Sleeper','Semi Sleeper','Luxury'] as $type)
                <option value="{{ $type }}"
                    {{ old('bus_type', $bus->bus_type ?? '') == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach

        </select>

        @error('bus_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Total Seats --}}
    <div class="col-md-6 mb-3">
        <label for="total_seats" class="form-label">
            Total Seats <span class="text-danger">*</span>
        </label>

        <input
            type="number"
            min="1"
            name="total_seats"
            id="total_seats"
            class="form-control @error('total_seats') is-invalid @enderror"
            value="{{ old('total_seats', $bus->total_seats ?? '') }}"
            placeholder="40">

        @error('total_seats')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    {{-- Status --}}
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status</label>

        <select
            name="status"
            id="status"
            class="form-control @error('status') is-invalid @enderror">

            <option value="1"
                {{ old('status', $bus->status ?? 1) == 1 ? 'selected' : '' }}>
                Active
            </option>

            <option value="0"
                {{ old('status', $bus->status ?? 1) == 0 ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="mt-3">
    <button type="submit" class="btn btn-primary">
        Save
    </button>

    <a href="{{ route('buses.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</div>

    </div>

</div>

@push('js')
<script>
    document.getElementById('logo')?.addEventListener('change', function () {
        const label = this.nextElementSibling;
        label.textContent = this.files[0]?.name || 'Choose logo file';
    });
</script>
@endpush
