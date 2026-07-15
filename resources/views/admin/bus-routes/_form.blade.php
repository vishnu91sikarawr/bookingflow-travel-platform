@csrf

<div class="card">
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>
                    <i class="fas fa-exclamation-triangle"></i>
                    Please fix the following errors:
                </h5>

                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Bus Operator
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="bus_operator_id"
                    class="form-control @error('bus_operator_id') is-invalid @enderror">

                    <option value="">Select Bus Operator</option>

                    @foreach($busOperators as $operator)
                        <option
                            value="{{ $operator->id }}"
                            {{ old('bus_operator_id', $busRoute->bus_operator_id ?? '') == $operator->id ? 'selected' : '' }}>
                            {{ $operator->name }}
                        </option>
                    @endforeach

                </select>

                @error('bus_operator_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Route Name
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $busRoute->name ?? '') }}"
                    placeholder="Delhi → Jaipur">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Source City
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="source_city"
                    class="form-control @error('source_city') is-invalid @enderror"
                    value="{{ old('source_city', $busRoute->source_city ?? '') }}">

                @error('source_city')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Destination City
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="destination_city"
                    class="form-control @error('destination_city') is-invalid @enderror"
                    value="{{ old('destination_city', $busRoute->destination_city ?? '') }}">

                @error('destination_city')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Distance (KM)
                </label>

                <input
                    type="number"
                    name="distance_km"
                    class="form-control"
                    value="{{ old('distance_km', $busRoute->distance_km ?? '') }}">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Estimated Duration
                </label>

                <input
                    type="text"
                    name="estimated_duration"
                    class="form-control"
                    placeholder="6 Hours"
                    value="{{ old('estimated_duration', $busRoute->estimated_duration ?? '') }}">

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Status
                </label>

                <select name="status" class="form-control">

                    <option value="1"
                        {{ old('status', $busRoute->status ?? 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ old('status', $busRoute->status ?? 1) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

        </div>

        <button class="btn btn-primary">
            Save
        </button>

        <a href="{{ route('bus-routes.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </div>
</div>