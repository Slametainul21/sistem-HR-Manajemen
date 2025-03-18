@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg rounded-lg overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0 font-weight-bold">Welcome Back!</h4>
                        <p class="text-white-50 mb-0">Sign in to your account</p>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="email" class="form-label text-muted">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </span>
                                    <input id="email" type="email" 
                                           class="form-control border-0 bg-light @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                </button>

                                @if (Route::has('forget.password.get'))
                                    <div class="text-center">
                                        <a class="text-muted text-decoration-none hover:text-primary" href="{{ route('forget.password.get') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                @endif
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

.form-control:focus {
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

.form-control {
    border-left: none;
}
</style>
@endsection
