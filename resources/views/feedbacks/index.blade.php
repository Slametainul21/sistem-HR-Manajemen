@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Feedback Management</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>User</th>
                                    <th>Feedback</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $feedback->material->title }}</td>
                                    <td>{{ $feedback->user->name }}</td>
                                    <td>{{ Str::limit($feedback->feedback, 100) }}</td>
                                    <td>{{ $feedback->rating }}/5</td>
                                    <td>{{ $feedback->status }}</td>
                                    <td>
                                        <a href="{{ route('feedbacks.show', $feedback->id) }}" class="btn btn-sm btn-info">View</a>
                                        @if(auth()->user()->role === 'hr')
                                        <a href="{{ route('feedbacks.review', $feedback->id) }}" class="btn btn-sm btn-primary">Review</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection