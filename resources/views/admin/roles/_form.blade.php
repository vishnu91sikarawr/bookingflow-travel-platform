@csrf

<div class="card">

    <div class="card-body">

        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Role Name --}}

        <div class="form-group mb-4">

            <label><strong>Role Name</strong></label>

            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $role->name ?? '') }}"
                placeholder="Enter Role Name">

            @error('name')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <hr>

        <h4 class="mb-4">

            <i class="fas fa-key"></i>

            Assign Permissions

        </h4>


        @foreach($permissions as $module => $modulePermissions)

            <div class="card card-outline card-primary mb-4">

                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">

                            {{ ucfirst($module) }}

                        </h5>

                        <div>

                            <input
                                type="checkbox"
                                class="select-all"
                                id="module_{{ $loop->index }}">

                            <label for="module_{{ $loop->index }}" class="mb-0">

                                Select All

                            </label>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="row">

                        @foreach($modulePermissions as $permission)

                            <div class="col-md-3 mb-3">

                                <div class="form-check">

                                    <input
                                        class="form-check-input permission-checkbox module-{{ $loop->parent->index }}"
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        id="permission{{ $permission->id }}"

                                        {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}

                                    >

                                    <label
                                        class="form-check-label"
                                        for="permission{{ $permission->id }}">

                                        
                                        {{ ucfirst(explode('.', $permission->name)[1]) }}

                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        @endforeach


        <div class="mt-4">

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Role

            </button>

            <a href="{{ route('roles.index') }}" class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </div>

</div>


@push('js')

<script>

$(document).ready(function(){

    $('.select-all').each(function(index){

        $(this).change(function(){

            $('.module-'+index).prop('checked', $(this).is(':checked'));

        });

    });

});

</script>

@endpush