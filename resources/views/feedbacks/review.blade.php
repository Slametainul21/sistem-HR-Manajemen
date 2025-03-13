@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Review Feedback</div>

                <div class="card-body">
                    <div class="feedback-details mb-4">
                        <h5>Original Feedback</h5>
                        <p><strong>Material:</strong> {{ $feedback->material->title }}</p>
                        <p><strong>User:</strong> {{ $feedback->user->name }}</p>
                        <p><strong>Feedback:</strong> {{ $feedback->feedback }}</p>
                        <p><strong>Rating:</strong> {{ $feedback->rating }}/5</p>
                    </div>

                    <form method="POST" action="{{ route('feedbacks.storeReview', $feedback->id) }}">
                        @csrf

                        <div class="form-group">
                            <label for="review">Your Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="4" required>{{ old('review') }}</textarea>
                            @error('review')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="score">Score</label>
                            <select class="form-control @error('score') is-invalid @enderror" id="score" name="score" required>
                                <option value="">Select Score</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('score')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Review</button>
                        <a href="{{ route('feedbacks.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection