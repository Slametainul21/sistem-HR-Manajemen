@extends('layouts.app')

@section('content')
<div class="dashboard-container bg-light min-vh-100">
    <div class="container py-4">
        <!-- Welcome Banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-white shadow-lg rounded-lg overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Welcome, {{ Auth::user()->name }}!</h4>
                                <p class="mb-0 opacity-75">Explore your learning materials</p>
                            </div>
                            <div class="dashboard-date">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <div class="search-container mb-4">
                    <form action="{{ route('employee.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search materials..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Materials Grid -->
        <div class="row g-4">
            @foreach($materials as $material)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="material-icon rounded-circle bg-primary-subtle p-3 me-3">
                                <i class="fas fa-file-alt text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">{{ $material->title }}</h5>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $material->category->name }}
                                </span>
                            </div>
                        </div>

                        <p class="card-text text-muted mb-3">
                            {{ Str::limit(strip_tags($material->description), 100) }}
                        </p>

                        <div class="mb-3">
                            @foreach($material->departments as $department)
                                <span class="badge bg-info-subtle text-info me-1 mb-1">
                                    {{ $department->name }}
                                </span>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                <i class="fas fa-eye me-1"></i>
                                {{ number_format($material->views, 0, ',', '.') }} views
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $material->created_at->format('M d, Y') }}
                            </div>
                            <a href="{{ route('materials.show', $material->id) }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    @if($material->file_path || $material->link)
                        <div class="card-footer bg-light border-0 py-3">
                            <div class="d-flex gap-2">
                                @if($material->file_path)
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="fas fa-file me-1"></i>Has attachment
                                    </span>
                                @endif
                                @if($material->link)
                                    <span class="badge bg-warning-subtle text-warning">
                                        <i class="fas fa-link me-1"></i>External link
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #4a90e2 0%, #3273dc 100%);
}

.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.material-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-primary-subtle {
    background-color: rgba(74, 144, 226, 0.1);
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1);
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1);
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

.input-group {
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-radius: 0.5rem;
    overflow: hidden;
}

.input-group-text, .form-control {
    border: 1px solid #eee;
}

.form-control:focus {
    box-shadow: none;
    border-color: #4a90e2;
}

.btn-primary {
    background: linear-gradient(135deg, #4a90e2 0%, #3273dc 100%);
    border: none;
    padding: 0.5rem 1rem;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
}
</style>
@endsection