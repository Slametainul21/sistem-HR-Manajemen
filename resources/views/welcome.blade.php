@extends('layouts.app')

@section('content')
<div class="landing-page">
    <!-- Hero Section -->
    <section class="hero min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Transform Your Workplace Knowledge</h1>
                    <p class="lead mb-4">Empower your organization with our comprehensive Knowledge Management System. Share, learn, and grow together.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="#features" class="btn btn-outline-primary btn-lg">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/employee.png') }}" alt="Hero" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose Our KMS?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-share-alt fa-3x text-primary mb-3"></i>
                            <h4>Easy Sharing</h4>
                            <p>Share knowledge and materials effortlessly across departments</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-comments fa-3x text-primary mb-3"></i>
                            <h4>Interactive Feedback</h4>
                            <p>Get valuable feedback from employees and improve continuously</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h4>Track Progress</h4>
                            <p>Monitor learning progress and material effectiveness</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <h2 class="display-4 fw-bold text-primary">500+</h2>
                    <p class="lead">Learning Materials</p>
                </div>
                <div class="col-md-4">
                    <h2 class="display-4 fw-bold text-primary">1000+</h2>
                    <p class="lead">Active Users</p>
                </div>
                <div class="col-md-4">
                    <h2 class="display-4 fw-bold text-primary">95%</h2>
                    <p class="lead">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Ready to Get Started?</h2>
                    <p class="lead mb-4">Join our knowledge-sharing community today and transform your workplace learning experience.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Sign Up Now</a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.landing-page {
    margin-top: -24px; /* Offset for fixed navbar */
}

.hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 100px 0;
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.fas {
    color: #0d6efd;
}

@media (max-width: 768px) {
    .hero {
        padding: 60px 0;
    }
}
</style>
@endsection
