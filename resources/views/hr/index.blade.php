@extends('layouts.app')

@section('content')
<div class="dashboard-container bg-light min-vh-100">
    <div class="container-fluid">
        <!-- Dashboard Header remains the same -->
        <div class="row mb-4 pt-4">
            <div class="col-12">
                <div class="card border-0 bg-primary text-white shadow-lg rounded-lg">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Welcome back, {{ Auth::user()->name }}!</h4>
                                <p class="mb-0">HR Dashboard</p>
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

        <!-- Modified Quick Actions - removed feedback card -->
        <!-- Remove the smaller Total Employees card and keep only the stats section -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <a href="{{ route('materials.create') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm hover-card h-100">
                        <div class="card-body p-4 text-center">
                            <div class="action-icon bg-primary-subtle rounded-circle mx-auto mb-3">
                                <i class="fas fa-plus fa-2x text-primary"></i>
                            </div>
                            <h5 class="card-title mb-0">Add Material</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm hover-card h-100">
                    <div class="card-body p-4 text-center">
                        <div class="action-icon bg-success-subtle rounded-circle mx-auto mb-3">
                            <i class="fas fa-book fa-2x text-success"></i>
                        </div>
                        <h5 class="card-title mb-0">Total Materials</h5>
                        <p class="display-6 mb-0 mt-2">{{ number_format($material->count(), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm hover-card h-100">
                    <div class="card-body p-4 text-center">
                        <div class="action-icon bg-info-subtle rounded-circle mx-auto mb-3">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                        <h5 class="card-title mb-0">Total Employees</h5>
                        <p class="display-6 mb-0 mt-2">{{ number_format($employeeCount) ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remove the duplicate stats section that was below -->
        <!-- Materials List remains the same -->
        <!-- Stats Section (Add this after the welcome banner) -->

<!-- Search Bar -->
<!-- Remove the larger search section and keep only the one in the materials card header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Learning Materials</h5>
                    <div class="d-flex gap-2">
                        <form action="{{ route('hr.index') }}" method="GET" class="d-flex gap-2">
                            <input type="text" 
                                   name="search" 
                                   class="form-control form-control-sm" 
                                   placeholder="Search materials..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4">Title</th>
                                <th class="border-0">Category</th>
                                <th class="border-0">Departments</th>
                                <th class="border-0">Views</th>
                                <th class="border-0">Created</th>
                                <th class="border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materials as $material)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt text-primary me-2"></i>
                                        {{ $material->title }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $material->category->name }}
                                    </span>
                                </td>
                                <td>
                                    @foreach($material->departments as $department)
                                        <span class="badge bg-info-subtle text-info me-1">
                                            {{ $department->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <i class="fas fa-eye text-muted me-1"></i>
                                    {{ number_format($material->views, 0, ',', '.') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($material->created_at)->translatedFormat('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('materials.show', $material->id) }}" 
                                           class="btn btn-link btn-sm text-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('materials.edit', $material->id) }}" 
                                           class="btn btn-link btn-sm text-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-link btn-sm text-danger"
                                                onclick="confirmDelete({{ $material->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $material->id }}" 
                                              action="{{ route('materials.destroy', $material->id) }}" 
                                              method="POST" 
                                              class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
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

<!-- Existing styles remain the same -->
<style>
.dashboard-container {
    padding-top: 1rem;
    padding-bottom: 2rem;
}

.hover-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}

.action-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.table th {
    font-weight: 600;
    font-size: 0.875rem;
}

.badge {
    font-weight: 500;
}

.btn-group .btn-link {
    padding: 0.25rem 0.5rem;
}

.btn-link:hover {
    background-color: #f8f9fa;
    border-radius: 0.25rem;
}
</style>

@push('scripts')
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3273dc',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
@endsection