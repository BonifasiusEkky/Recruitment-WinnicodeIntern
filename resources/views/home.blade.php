<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('partials.navbar') <!-- Panggil Navbar -->

    @guest
        <!-- Jika belum login -->
        <div class="hero">
            <div class="hero-overlay"></div>
            <div class="container text-center hero-content">
                <h1 class="fw-bold">Find The Perfect Job That You Deserved</h1>
                <p>You can search your job, your passion, and build the future you’ve always dreamed of.</p>
                <a href="{{ route('login') }}" class="btn btn-primary px-4">Explore Job</a>
            </div>
        </div>
    @else
        <!-- Jika sudah login -->
        <div class="hero">
            <div class="hero-overlay"></div>
            <div class="container text-center hero-content">
                <h1 class="fw-bold">Welcome, {{ Auth::user()->name }}!</h1>
                <p>Discover new job opportunities that match your skills and interests.</p>
                <a href="#" class="btn btn-primary px-4">Browse Jobs</a>
            </div>
        </div>

    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
