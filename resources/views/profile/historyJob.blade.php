<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Job - CompanyJob</title>
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
        .job-table {
            width: 100%;
            border-collapse: collapse;
        }
        .job-table th, .job-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .job-table th {
            background-color: #f8f9fa;
        }
        .job-table .btn {
            padding: 5px 10px;
            font-size: 0.9rem;
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
        <!-- History Job -->
        <div class="profile-card flex-grow-1">
            <div class="main-content">
                <h3 class="fw-bold">History Job</h3>
                <hr>
                @if ($applications->isEmpty())
                    <p class="text-center">Tidak ada riwayat lamaran.</p>
                @else
                    <table class="job-table">
                        <thead>
                            <tr>
                                <th>Posisi</th>
                                <th>Perusahaan</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $application->job->posisi ?? 'Tidak ada data' }}</td>
                                    <td>{{ $application->job->nama_perusahaan ?? 'Tidak ada data' }}</td>
                                    <td>{{ $application->status ?? 'Tidak ada status' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>