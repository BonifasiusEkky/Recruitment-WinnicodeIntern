<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard HRD – {{ $companyName ?? 'CompanyJob' }}</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Custom CSS for Spark theme -->
    <style>
        :root {
            --primary-bg: #1e3a8a; /* Warna biru tua untuk header */
            --sidebar-bg: #ffffff; /* Sidebar putih */
            --card-bg: #ffffff; /* Kartu putih */
            --card-border: rgba(0,0,0,0.05);
            --text-color: #2f3e4e; /* Teks utama */
            --header-text: #ffffff; /* Teks header putih */
            --content-bg: #e5e7eb; /* Latar belakang konten */
        }
        /* Navbar */
        .main-header.navbar {
            background-color: var(--primary-bg) !important;
        }
        /* Sidebar */
        .spark-sidebar {
            background-color: var(--sidebar-bg) !important;
        }
        .spark-sidebar .brand-link {
            background-color: var(--primary-bg) !important;
            color: var(--header-text) !important;
        }
        .spark-sidebar .brand-link .brand-text {
            color: var(--header-text) !important;
        }
        .spark-sidebar .user-panel {
            flex-direction: column;
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding-bottom: 1rem;
        }
        .spark-sidebar .user-panel .image img {
            width: 48px;
            height: 48px;
            margin-bottom: 0.5rem;
        }
        .spark-sidebar .user-panel .info a {
            color: var(--text-color) !important;
            font-weight: 600;
        }
        .spark-sidebar .user-panel .info small {
            color: #6c757d;
            display: block;
            font-size: 0.75rem;
        }
        .spark-sidebar .nav-header {
            font-size: 0.75rem;
            font-weight: bold;
            color: #6c757d;
            margin-top: 1rem;
            padding-left: 1rem;
        }
        .spark-sidebar .nav-sidebar > .nav-item > .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
        }
        .spark-sidebar .nav-icon {
            width: 1.25rem;
        }
        .spark-sidebar .has-treeview .nav-link .right {
            transition: transform 0.2s ease;
        }
        .spark-sidebar .menu-open > .nav-link .right {
            transform: rotate(180deg);
        }
        /* Content Wrapper */
        .content-wrapper {
            background-color: var(--content-bg) !important;
        }
        /* Cards */
        .small-box {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .small-box .inner h3 {
            color: var(--text-color);
            font-size: 2rem;
        }
        .small-box .inner p {
            color: #6c757d;
            font-size: 1rem;
        }
        .small-box .icon {
            color: var(--primary-bg);
            opacity: 0.7;
        }
        /* Chart Card */
        .card {
            background-color: var(--card-bg);
            color: var(--text-color);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: transparent;
            border-bottom: none;
        }
        .card-title {
            color: var(--text-color);
        }
        /* Footer */
        .main-footer {
            background-color: var(--card-bg);
            color: var(--text-color);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
        {{-- Sidebar --}}
        @include('hrd.partials.sidebar')
        {{-- Navbar --}}

        @include('hrd.partials.navbar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <br>
                <br>
                <br>
            
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Recent Movement Chart -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Movement</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="recentMovementChart" style="height:200px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Small boxes -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <h3>6</h3>
                                        <p>Total Jobs</p>
                                        <br>
                                    </div>
                                    <div class="icon"><i class="fas fa-briefcase"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <h3>10</h3>
                                        <p>Accepted</p>
                                        <br>
                                    </div>
                                    <div class="icon"><i class="fas fa-user-check"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <h3>16</h3>
                                        <p>Total Candidate</p>
                                        <br>
                                    </div>
                                    <div class="icon"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <h3>6</h3>
                                        <p>Rejected</p>
                                        <br>
                                    </div>
                                    <div class="icon"><i class="fas fa-user-times"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    @include('hrd.partials.footer')


</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    $(function(){
        var ctx = document.getElementById('recentMovementChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Movement',
                    data: [3,7,12,15,20,25,22,18,14,10,7,5],
                    backgroundColor: 'rgba(30, 58, 138, 0.3)', /* Warna biru tua dengan opacity */
                    borderColor: '#1e3a8a',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { color: '#2f3e4e' } },
                    x: { ticks: { color: '#2f3e4e' } }
                },
                plugins: { legend: { labels: { color: '#2f3e4e' } } }
            }
        });
    });
</script>
</body>
</html>