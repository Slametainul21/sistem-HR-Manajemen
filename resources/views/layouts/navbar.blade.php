<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="me-2">
            <span class="fw-bold text-primary">KnowledgeHR</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary mx-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ auth()->user()->isHR() ? route('hr.index') : route('employee.index') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
/* Add these styles at the bottom of navbar.blade.php */
body {
    padding-top: 2rem; /* Height of navbar + some spacing */
}

.navbar {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.navbar-brand {
    font-weight: 600;
}

.nav-link {
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: #4a90e2 !important;
}
</style>