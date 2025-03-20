@extends('layouts.app')

@section('content')
<div class="landing-page d-flex flex-column min-vh-100">
    <div class="content flex-grow-1">
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
                        <img src="{{ asset('images/employee.png') }}" alt="Hero" class="img-fluid hero-image">
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

        <!-- Footer Section -->
        <section class="footer bg-dark text-white py-5 mt-auto">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h5 class="mb-4 text-primary fw-bold">KnowledgeHR</h5>
                        <p class="mb-4">Empowering organizations through effective knowledge management and continuous learning.</p>
                        <div class="social-links">
                            <a href="#" class="me-3 text-white-50 hover-light"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="me-3 text-white-50 hover-light"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-3 text-white-50 hover-light"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white-50 hover-light"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h6 class="mb-4 text-white-50 text-uppercase">Quick Links</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-light">About Us</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-light">Features</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-light">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h6 class="mb-4 text-white-50 text-uppercase">Resources</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-light">Documentation</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-light">Help Center</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-light">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h6 class="mb-4 text-white-50 text-uppercase">Newsletter</h6>
                        <p class="text-white-50">Subscribe to our newsletter for updates</p>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control bg-dark border-dark text-white" placeholder="Enter your email">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </div>
                </div>
                <hr class="mt-5 mb-4 border-secondary">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-white-50">© {{ date('Y') }} KnowledgeHR. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <small class="text-white-50">Made with <i class="fas fa-heart text-danger"></i> for better workplace learning</small>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.container,
.row {
    margin-bottom: 0;
    padding-bottom: 0;
}

.landing-page {
    margin: -24px 0 0 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
}

.content {
    flex: 1 0 auto;
    background-color: white;
    display: flex;
    flex-direction: column;
}

.footer {
    margin-top: auto;
    padding: 20px 0; /* Keep padding clean */
}

.hero {
    position: relative;
    background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7)), 
                url('../images/background.avif');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 100px 0;
    width: 100%;         /* Add this line */
}

.hero-image {
    transform: scale(1.2);
    margin: 20px 0;
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

.footer {
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
}

.hover-light {
    transition: all 0.3s ease;
}

.hover-light:hover {
    color: white !important;
    opacity: 1;
}

.social-links a {
    font-size: 1.25rem;
    transition: transform 0.3s ease;
    display: inline-block;
}

.social-links a:hover {
    transform: translateY(-3px);
}

.form-control:focus {
    background-color: #2b2b2b;
    border-color: #4a90e2;
    box-shadow: none;
    color: white;
}
</style>
@endsection
