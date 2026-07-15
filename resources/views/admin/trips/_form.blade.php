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

            {{-- Bus Operator --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Bus Operator <span class="text-danger">*</span>
                </label>

                <select
                    name="bus_operator_id"
                    class="form-control @error('bus_operator_id') is-invalid @enderror">

                    <option value="">Select Bus Operator</option>

                    @foreach($busOperators as $operator)
                        <option
                            value="{{ $operator->id }}"
                            {{ old('bus_operator_id', $trip->bus_operator_id ?? '') == $operator->id ? 'selected' : '' }}>
                            {{ $operator->name }}
                        </option>
                    @endforeach

                </select>

                @error('bus_operator_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Bus --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Bus <span class="text-danger">*</span>
                </label>

                <select
                    name="bus_id"
                    class="form-control @error('bus_id') is-invalid @enderror">

                    <option value="">Select Bus</option>

                    @foreach($buses as $bus)
                        <option
                            value="{{ $bus->id }}"
                            {{ old('bus_id', $trip->bus_id ?? '') == $bus->id ? 'selected' : '' }}>
                            {{ $bus->name }}
                        </option>
                    @endforeach

                </select>

                @error('bus_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Route --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Bus Route <span class="text-danger">*</span>
                </label>

                <select
                    name="bus_route_id"
                    class="form-control @error('bus_route_id') is-invalid @enderror">

                    <option value="">Select Route</option>

                    @foreach($busRoutes as $route)
                        <option
                            value="{{ $route->id }}"
                            {{ old('bus_route_id', $trip->bus_route_id ?? '') == $route->id ? 'selected' : '' }}>
                            {{ $route->name }}
                        </option>
                    @endforeach

                </select>

                @error('bus_route_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="row">

            {{-- Departure Date --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Departure Date <span class="text-danger">*</span>
                </label>

                <input
                    type="date"
                    name="departure_date"
                    class="form-control @error('departure_date') is-invalid @enderror"
                    value="{{ old('departure_date', isset($trip) ? $trip->departure_date?->format('Y-m-d') : '') }}">

                @error('departure_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Departure Time --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Departure Time <span class="text-danger">*</span>
                </label>

                <input
                    type="time"
                    name="departure_time"
                    class="form-control @error('departure_time') is-invalid @enderror"
                    value="{{ old('departure_time', $trip->departure_time ?? '') }}">

                @error('departure_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Arrival Time --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Arrival Time <span class="text-danger">*</span>
                </label>

                <input
                    type="time"
                    name="arrival_time"
                    class="form-control @error('arrival_time') is-invalid @enderror"
                    value="{{ old('arrival_time', $trip->arrival_time ?? '') }}">

                @error('arrival_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="row">

            {{-- Fare --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Fare <span class="text-danger">*</span>
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="fare"
                    class="form-control @error('fare') is-invalid @enderror"
                    value="{{ old('fare', $trip->fare ?? '') }}">

                @error('fare')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Status --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-control">

                    <option value="1"
                        {{ old('status', $trip->status ?? 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ old('status', $trip->status ?? 1) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

        </div>

        <button class="btn btn-primary">
            Save
        </button>

        <a href="{{ route('trips.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

    </div>
</div>