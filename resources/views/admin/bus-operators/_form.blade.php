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

            <div class="col-md-6 mb-3">

                <label>Name <span class="text-danger">*</span></label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $busOperator->name ?? '') }}"
                    placeholder="Enter operator name"
                    required>

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Code <span class="text-danger">*</span></label>

                <input
                    type="text"
                    name="code"
                    class="form-control @error('code') is-invalid @enderror"
                    value="{{ old('code', $busOperator->code ?? '') }}"
                    placeholder="e.g. GLT001"
                    required>

                @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $busOperator->email ?? '') }}"
                    placeholder="contact@operator.com">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $busOperator->phone ?? '') }}"
                    placeholder="+91 98765 43210">

                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Website</label>

                <input
                    type="url"
                    name="website"
                    class="form-control @error('website') is-invalid @enderror"
                    value="{{ old('website', $busOperator->website ?? '') }}"
                    placeholder="https://example.com">

                @error('website')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Logo</label>

                @if(isset($busOperator) && $busOperator->logo)

                    <div class="mb-2">

                        <img
                            src="{{ asset('storage/' . $busOperator->logo) }}"
                            alt="{{ $busOperator->name }}"
                            class="img-thumbnail"
                            style="max-height: 80px;">

                    </div>

                @endif

                <div class="custom-file">

                    <input
                        type="file"
                        name="logo"
                        class="custom-file-input @error('logo') is-invalid @enderror"
                        id="logo"
                        accept="image/jpeg,image/png,image/webp">

                    <label class="custom-file-label" for="logo">
                        Choose logo file
                    </label>

                </div>

                <small class="form-text text-muted">
                    Allowed: JPG, JPEG, PNG, WEBP. Max size: 2MB.
                </small>

                @error('logo')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-12 mb-3">

                <label>Address</label>

                <textarea
                    name="address"
                    class="form-control @error('address') is-invalid @enderror"
                    rows="2"
                    placeholder="Enter address">{{ old('address', $busOperator->address ?? '') }}</textarea>

                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-12 mb-3">

                <label>Description</label>

                <textarea
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="3"
                    placeholder="Enter description">{{ old('description', $busOperator->description ?? '') }}</textarea>

                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Status</label>

                <div class="custom-control custom-switch mt-2">

                    <input
                        type="checkbox"
                        class="custom-control-input"
                        id="status"
                        name="status"
                        value="1"
                        {{ old('status', $busOperator->status ?? true) ? 'checked' : '' }}>

                    <label class="custom-control-label" for="status">
                        Active
                    </label>

                </div>

                @error('status')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

        <button class="btn btn-success">
            <i class="fas fa-save"></i>
            {{ isset($busOperator) ? 'Update Bus Operator' : 'Save Bus Operator' }}
        </button>

        <a href="{{ route('bus-operators.index') }}" class="btn btn-secondary">
            Cancel
        </a>

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
