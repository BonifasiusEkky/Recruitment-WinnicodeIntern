<style></style>
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="{{ route('home') }}">CompanyJob</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('jobs.index') }}" >Jobs</a> 
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('profile.index') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm nav-link border-0">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
