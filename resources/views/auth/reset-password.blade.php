@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reset Password</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label>Email</label>
        <input type="email" name="email" required class="form-control">
        <label>Password</label>
        <input type="password" name="password" required class="form-control">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required class="form-control">
        <button type="submit" class="btn btn-primary mt-2">Reset Password</button>
    </form>
</div>
@endsection
