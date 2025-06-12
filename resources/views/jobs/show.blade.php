<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Detail - CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .job-header {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .job-header img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            margin-right: 15px;
        }
        .job-header .header-info {
            flex-grow: 1;
        }
        .job-header .header-info h5 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .job-header .header-info .details {
            display: flex;
            gap: 15px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .job-header .header-info .details i {
            margin-right: 5px;
        }
        .job-header .header-info .salary {
            font-size: 1.1rem;
            font-weight: 600;
            color: #28a745;
        }
        .job-header .btn-apply {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .job-header .btn-apply:hover {
            background-color: #0b5ed7;
        }
        .job-header .btn-applied {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: not-allowed;
        }
        .job-details {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .job-details h6 {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .job-details ul {
            padding-left: 20px;
            margin-bottom: 20px;
        }
        .job-details ul li {
            margin-bottom: 5px;
        }
        .job-details .additional-info {
            display: flex;
            gap: 20px;
            font-size: 0.9rem;
        }
        .job-details .additional-info div {
            flex: 1;
        }
        .job-details .additional-info div strong {
            display: block;
            color: #333;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-4">
        <!-- Job Header -->
        <div class="job-header">
            <img src="{{ asset('images/logodefault.jpeg') }}" alt="Company Logo">
            <div class="header-info">
                <h5>{{ $job->posisi }}</h5>
                <div class="details">
                    <span><i class="fas fa-map-marker-alt"></i>{{ $job->tempat_kerja }}</span>
                    <span><i class="fas fa-clock"></i>{{ ucfirst(str_replace('-', ' ', $job->tipe_pekerjaan)) }}</span>
                </div>
                <div class="salary">Rp {{ number_format($job->gaji, 0, ',', '.') }}</div>
            </div>
            @auth
                @if ($job->applications()->where('user_id', auth()->id())->exists())
                    @php
                        $application = $job->applications()->where('user_id', auth()->id())->first();
                    @endphp
                    <button class="btn-applied" disabled>Status: {{ ucfirst($application->status) }}</button>
                @else
                    <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-apply">Apply</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-apply">Login to Apply</a>
            @endauth
        </div>

        <!-- Job Details -->
        <div class="job-details">
            <h6>Job Description</h6>
            <ul>
                @foreach (array_filter(explode('.', $job->deskripsi_pekerjaan)) as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            </ul>

            <h6>Requirement</h6>
            <ul>
                @foreach (array_filter(explode('.', $job->requirements)) as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            </ul>

            <h6>Informasi Tambahan</h6>
            <div class="additional-info">
                <div>
                    <strong>Role</strong>
                    <span>{{ $job->posisi }}</span>
                </div>
                <div>
                    <strong>Tipe Pekerjaan</strong>
                    <span>{{ ucfirst(str_replace('-', ' ', $job->tipe_pekerjaan)) }}</span>
                </div>
                <div>
                    <strong>Estimasi Gaji</strong>
                    <span>Rp {{ number_format($job->gaji, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>