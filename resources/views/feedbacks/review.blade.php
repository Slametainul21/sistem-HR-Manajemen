@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Review Feedback
                        <a href="{{ route('feedbacks.index') }}" class="btn btn-secondary btn-sm float-end">Back</a>
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
                                <label for="review">Your Review</label>
                                <textarea name="review" id="review" class="form-control @error('review') is-invalid @enderror" rows="3"
                                    required>{{ old('review', $feedback->reviews->review ?? '') }}</textarea>
                                @error('review')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="score">Rating</label>
                                <select name="score" id="score"
                                    class="form-control @error('score') is-invalid @enderror" required>
                                    <option value="">Select Score</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('score', $feedback->reviews->score ?? '') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('score')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="status">Review Status</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="approved"
                                        {{ old('status', $feedback->reviews->status ?? '') == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected"
                                        {{ old('status', $feedback->reviews->status ?? '') == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                    <option value="noted"
                                        {{ old('status', $feedback->reviews->status ?? '') == 'noted' ? 'selected' : '' }}>
                                        Noted</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
