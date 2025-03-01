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
        .profile-container {
            display: flex;
            gap: 20px;
            margin-top: 50px;
        }
        .profile-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            width: 280px;
            padding: 20px;
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
            color: white;
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #0d6efd;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    <div class="container profile-container">
        <!-- Sidebar -->
        <div class="profile-card sidebar">
            <div class="profile-picture">
                <img src="{{ asset('images/default-avatar.png') }}" alt="User Avatar" onerror="this.src='https://via.placeholder.com/100'">
                <h5 class="mt-2">{{ auth()->user()->name }}</h5>
            </div>
            <a href="#" class="active"><i class="fas fa-user"></i> Profile</a>
            <a href="#"><i class="fas fa-file-alt"></i> Fill Document</a>
            <a href="#"><i class="fas fa-history"></i> History</a>
            <a href="#"><i class="fas fa-lock"></i> Change Password</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Profile Details -->
        <div class="profile-card flex-grow-1">
        <div class="profile-info">
            <h3 class="fw-bold">Profile</h3>
            <hr>
            <div class="mb-2"><span>Name</span> <br> {{ auth()->user()->name ?? 'Not specified' }}</div>
            <div class="mb-2"><span>Gender</span> <br>{{ auth()->user()->profile->gender ?? 'Not specified' }}</div>
            <div class="mb-2"><span>Date of Birth</span> <br> {{ auth()->user()->profile->tanggal_lahir ?? 'Not specified' }}</div>
            <div class="mb-2"><span>Address</span> <br>{{ auth()->user()->profile->alamat ?? 'Not specified' }}</div>
            <button class="btn btn-primary custom-btn mt-3">Edit</button>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
