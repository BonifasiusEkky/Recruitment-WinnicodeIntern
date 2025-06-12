<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job List - CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .header-section {
            position: relative;
            background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            height: 200px;
            color: white;
            display: flex;
            align-items: center;
            padding-left: 50px;
        }
        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .header-section h1 {
            position: relative;
            z-index: 1;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .breadcrumb {
            position: relative;
            z-index: 1;
            background: transparent;
            padding: 0;
            margin-top: 10px;
        }
        .breadcrumb a {
            color: #fff;
            text-decoration: none;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .breadcrumb .active {
            color: #ccc;
        }
        .filter-buttons {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            justify-content: center;
        }
        .filter-buttons a {
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        .filter-buttons a.active {
            background-color: #0d6efd;
            color: #fff;
        }
        .filter-buttons a:not(.active) {
            background-color: #e9ecef;
            color: #333;
        }
        .job-card {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
        .job-card img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            margin-right: 15px;
        }
        .job-info {
            flex-grow: 1;
        }
        .job-info h5 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .job-info .company {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .job-info .details {
            display: flex;
            gap: 15px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .job-info .details i {
            margin-right: 5px;
        }
        .job-card .salary {
            font-size: 1.1rem;
            font-weight: 600;
            color: #28a745;
            margin-right: 15px;
        }
        .job-card .btn-detail {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .job-card .btn-detail:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <!-- Header Section -->
    <div class="header-section">
        <div>
            <h1>Job List</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Job List</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Job List Section -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Job List</h2>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <a href="{{ route('jobs.index') }}" class="{{ !$type ? 'active' : '' }}">All</a>
            <a href="{{ route('jobs.index', ['type' => 'full_time']) }}" class="{{ $type == 'full_time' ? 'active' : '' }}">Full Time</a>
            <a href="{{ route('jobs.index', ['type' => 'part_time']) }}" class="{{ $type == 'part_time' ? 'active' : '' }}">Part Time</a>
        </div>

        <!-- Job Cards -->
        @forelse ($jobs as $job)
            <div class="job-card">
                <img src="{{ asset('images/logodefault.jpeg') }}" alt="Company Logo">
                <div class="job-info">
                    <h5>{{ $job->posisi }}</h5>
                    <div class="company">{{ $job->nama_perusahaan }}</div>
                    <div class="details">
                        <span><i class="fas fa-map-marker-alt"></i>{{ $job->tempat_kerja }}</span>
                        <span><i class="fas fa-clock"></i>{{ ucfirst(str_replace('-', ' ', $job->tipe_pekerjaan)) }}</span>
                    </div>
                </div>
                <div class="salary">Rp {{ number_format($job->gaji, 0, ',', '.') }}</div>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn-detail">Detail</a>
            </div>
        @empty
            <p class="text-center">No jobs available.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>