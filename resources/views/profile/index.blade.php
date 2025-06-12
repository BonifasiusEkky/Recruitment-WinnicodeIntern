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
        .document-section {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .document-section label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }
        .document-section .help-text {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 10px;
        }
        .document-section small {
            color: #6c757d;
            margin-left: 10px;
        }
        .btn-choose, .btn-change {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-change {
            background-color: #6c757d;
        }
        .btn-choose:hover, .btn-change:hover {
            opacity: 0.9;
        }
        .btn-submit {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-submit:hover {
            background-color: #0d6efd;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    <div class="container profile-container">
        <!-- Sidebar -->
        @include ('partials.sidebar-profile')
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
