<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 20px;
        }
        .navbar-brand {
            font-weight: bold;
            color: #000;
        }
        .nav-link {
            color: #000;
            margin-left: 15px;
        }
        .nav-link:hover {
            color: #0d6efd;
        }
        .profile-container {
            display: flex;
            gap: 20px;
            margin: 50px auto;
            max-width: 1200px;
        }
        .profile-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            width: 280px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0d6efd;
            color: #fff;
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #0d6efd;
        }
        .sidebar .user-name {
            font-size: 1.1rem;
            font-weight: 500;
            margin-top: 10px;
        }
        .main-content {
            flex-grow: 1;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .main-content h3 {
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    <div class="container profile-container">
        <!-- Sidebar -->
        <div class="sidebar">
            @include('partials.sidebar-profile')
        </div>
        <!-- Profile Details -->
        <div class="profile-card flex-grow-1">
            <div class="profile-info">
                <h3 class="fw-bold">Profile</h3>
                <hr>
                <div class="mb-2"><span>Name</span> <br> {{ auth()->user()->name ?? 'Not specified' }}</div>
                <div class="mb-2"><span>Gender</span> <br> {{ auth()->user()->profile->gender ?? 'Not specified' }}</div>
                <div class="mb-2"><span>Date of Birth</span> <br> {{ auth()->user()->profile->tanggal_lahir ?? 'Not specified' }}</div>
                <div class="mb-2"><span>Address</span> <br> {{ auth()->user()->profile->alamat ?? 'Not specified' }}</div>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary custom-btn mt-3">Edit</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>