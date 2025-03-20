@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-lg overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0 font-weight-bold">Create Your Account</h4>
                        <p class="text-white-50 mb-0">Join our knowledge management system</p>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label text-muted">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-user text-primary"></i>
                                            </span>
                                            <input id="name" type="text" class="form-control border-0 bg-light @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email" class="form-label text-muted">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-envelope text-primary"></i>
                                            </span>
                                            <input id="email" type="email" class="form-control border-0 bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="role_id" class="form-label text-muted">Role</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-user-tag text-primary"></i>
                                            </span>
                                            <select id="role_id" class="form-select border-0 bg-light @error('role_id') is-invalid @enderror" name="role_id" required>
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('role_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="department_id" class="form-label text-muted">Department</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-building text-primary"></i>
                                            </span>
                                            <select id="department_id" class="form-select border-0 bg-light" name="department_id" required>
                                                <option value="">Select Department</option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password" class="form-label text-muted">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-lock text-primary"></i>
                                            </span>
                                            <input id="password" type="password" 
                                                   class="form-control border-0 bg-light @error('password') is-invalid @enderror" 
                                                   name="password" required>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password-confirm" class="form-label text-muted">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-lock text-primary"></i>
                                            </span>
                                            <input id="password-confirm" type="password" 
                                                   class="form-control border-0 bg-light" 
                                                   name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-primary px-5 py-2">
                                    <i class="fas fa-user-plus me-2"></i>Create Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
}

.form-control:focus, .form-select:focus {
    box-shadow: none;
    border-color: #4a90e2;
}

.btn-primary {
    background: linear-gradient(135deg, #4a90e2 0%, #3273dc 100%);
    border: none;
    transition: transform 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
}

.input-group-text {
    border-right: none;
}

.form-control, .form-select {
    border-left: none;
}
</style>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role_id');
    const departmentSelect = document.getElementById('department_id');
    const hrDepartmentId = "0"; // HR department ID
    const hrRoleId = "0"; // HR role ID

    // Disable the default "Select" options
    roleSelect.querySelector('option[value=""]').disabled = true;
    departmentSelect.querySelector('option[value=""]').disabled = true;

    function updateDepartments() {
        const selectedRole = roleSelect.value;
        
        Array.from(departmentSelect.options).forEach(option => {
            if (option.value === hrDepartmentId) {
                if (selectedRole === hrRoleId) {
                    option.disabled = false;
                    option.selected = true;
                    departmentSelect.disabled = true;
                } else {
                    option.disabled = true;
                    option.selected = false;
                    departmentSelect.disabled = false;
                }
            } else if (option.value !== "") {
                option.disabled = (selectedRole === hrRoleId);
            }
        });
    }

    roleSelect.addEventListener('change', updateDepartments);
    updateDepartments();
});
</script>
