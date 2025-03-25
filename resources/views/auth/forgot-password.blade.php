@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg rounded-lg overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0 font-weight-bold">Forgot Password?</h4>
                        <p class="text-white-50 mb-0">Enter your email to reset your password</p>
                    </div>

                    <div class="card-body p-5">
                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('forget.password.post') }}">
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

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <i class="fas fa-paper-plane me-2"></i> Send Reset Link
                                </button>
                                <div class="text-center mt-3">
                                    <a class="text-muted text-decoration-none hover:text-primary" href="{{ route('login') }}">
                                        Back to Login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection