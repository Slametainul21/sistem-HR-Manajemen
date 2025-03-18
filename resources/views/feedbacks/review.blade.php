@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Review Feedback
                    <a href="{{ route('hr.index') }}" class="btn btn-secondary btn-sm float-end">Back</a>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Material: {{ $feedback->material->title }}</h5>
                        <p class="text-muted">Submitted by: {{ $feedback->user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Feedback Content:</h5>
                        <p>{{ $feedback->content }}</p>
                    </div>

                    <form action="{{ route('feedbacks.storeReview', $feedback->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="hr_response">Your Response</label>
                            <textarea name="hr_response" id="hr_response" class="form-control @error('hr_response') is-invalid @enderror" rows="3" required>{{ old('hr_response', $feedback->hr_response) }}</textarea>
                            @error('hr_response')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit Response</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection