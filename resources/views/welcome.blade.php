@extends('layouts.app')

@section('content')
<div class="landing-page d-flex flex-column min-vh-100">
    <div class="content flex-grow-1">
        <!-- Hero Section -->
        <section class="hero d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="fw-bold mb-4">Transform Your Workplace Knowledge</h1>
                        <p class="lead text-muted mb-4">
                            Empower your organization with our comprehensive Knowledge Management System. 
                            Share, learn, and grow together.
                        </p>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg shadow">Get Started</a>
                            <a href="#features" class="btn btn-outline-primary btn-lg">Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('images/herro.png') }}" alt="Hero" class="img-fluid hero-image">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Why Choose Our KMS?</h2>
                <div class="row g-4">
                    @foreach([
                        ['icon' => 'fas fa-share-alt', 'title' => 'Easy Sharing', 'desc' => 'Share knowledge effortlessly across departments'],
                        ['icon' => 'fas fa-comments', 'title' => 'Interactive Feedback', 'desc' => 'Get valuable feedback from employees'],
                        ['icon' => 'fas fa-chart-line', 'title' => 'Track Progress', 'desc' => 'Monitor learning effectiveness']
                    ] as $feature)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center">
                                <div class="card-body">
                                    <i class="{{ $feature['icon'] }} fa-3x text-primary mb-3"></i>
                                    <h4>{{ $feature['title'] }}</h4>
                                    <p class="text-muted">{{ $feature['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

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
        <section class="cta text-center py-5 bg-white">
            <div class="container">
                <h2 class="mb-4 fw-bold">Ready to Get Started?</h2>
                <p class="lead text-muted mb-4">Join our knowledge-sharing community today.</p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg shadow">Sign Up Now</a>
            </div>
        </section>
        

        <!-- Footer -->
        <footer class="footer bg-dark text-white py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h5 class="text-primary fw-bold">KnowledgeHR</h5>
                        <p class="text-white-50">Empowering organizations through effective knowledge management and continuous learning.</p>
                        <div class="d-flex gap-3">
                            @foreach(['linkedin', 'twitter', 'facebook', 'instagram'] as $social)
                                <a href="#" class="text-white-50"><i class="fab fa-{{ $social }} fa-lg"></i></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h6 class="text-white-50">Quick Links</h6>
                        <ul class="list-unstyled">
                            @foreach(['About Us', 'Features', 'Contact'] as $link)
                                <li><a href="#" class="text-white-50 text-decoration-none">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h6 class="text-white-50">Resources</h6>
                        <ul class="list-unstyled">
                            @foreach(['Documentation', 'Help Center', 'Privacy Policy'] as $resource)
                                <li><a href="#" class="text-white-50 text-decoration-none">{{ $resource }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h6 class="text-white-50">Newsletter</h6>
                        <p class="text-white-50">Subscribe to our newsletter for updates</p>
                        <div class="input-group">
                            <input type="email" class="form-control bg-dark border-dark text-white" placeholder="Enter your email">
                        </div>
                    </div>
                </div>
                <hr class="mt-5 border-secondary">
                <div class="row text-center">
                    <div class="col">
                        <p class="text-white-50">&copy; {{ date('Y') }} KnowledgeHR. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<style>
.landing-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
}

.hero {
    background:  url('../images/back.jpg');
    background-size: cover;
    background-position: center;
    padding: 60px 0;
    min-height: 75vh;
}

.hero-image {
    max-width: 100%;
    height: auto;
}

.card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease-in-out;
}

.cta {
    background: #f8f9fa;
}

.footer {
    margin-top: auto;
    padding-top: 40px;
}
</style>
@endsection