<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard HRD – Create Job – {{ $companyName ?? 'CompanyJob' }}</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <style>
    :root {
      --primary-bg: #1e3a8a;
      --sidebar-bg: #ffffff;
      --card-bg: #ffffff;
      --text-color: #2f3e4e;
      --header-text: #ffffff;
      --content-bg: #e5e7eb;
    }
    .main-header.navbar { background-color: var(--primary-bg) !important; }
    .spark-sidebar { background-color: var(--sidebar-bg) !important; }
    .spark-sidebar .brand-link { background-color: var(--primary-bg) !important; color: var(--header-text) !important; }
    .spark-sidebar .brand-link .brand-text { color: var(--header-text) !important; }
    .spark-sidebar .user-panel { flex-direction: column; text-align: center; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 1rem; }
    .spark-sidebar .user-panel .image img { width: 48px; height: 48px; margin-bottom: 0.5rem; }
    .spark-sidebar .user-panel .info a { color: var(--text-color) !important; font-weight: 600; }
    .spark-sidebar .user-panel .info small { color: #6c757d; display: block; font-size: 0.75rem; }
    .spark-sidebar .nav-header { font-size: 0.75rem; font-weight: bold; color: #6c757d; margin-top: 1rem; padding-left: 1rem; }
    .spark-sidebar .nav-sidebar > .nav-item > .nav-link { color: var(--text-color) !important; font-weight: 500; }
    .spark-sidebar .nav-icon { width: 1.25rem; }
    .spark-sidebar .has-treeview .nav-link .right { transition: transform 0.2s ease; }
    .spark-sidebar .menu-open > .nav-link .right { transform: rotate(180deg); }
    .content-wrapper { background-color: var(--content-bg) !important; }
    .card {
      background-color: var(--card-bg);
      color: var(--text-color);
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      max-width: none;
      margin: 0;
    }
    .card-header { background-color: transparent; border-bottom: none; }
    .card-title { color: var(--text-color); }
    .main-footer { background-color: var(--card-bg); color: var(--text-color); }
    .no-gutters { margin-right: 0; margin-left: 0; }
    .no-gutters > [class*='col-'] {
      padding-right: 0;
      padding-left: 0;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  {{-- Navbar & Sidebar --}}
  @include('hrd.partials.navbar')
  @include('hrd.partials.sidebar')

  <!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <h1>Create Job</h1>
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="{{ route('hrd.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Jobs</a></li>
          <li class="breadcrumb-item active">Create Job</li>
        </ol>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-12">
        <br>
        <div class="card">
          <div class="card-header">
            <!-- optional header content -->
          </div>

          <form action="{{ route('hrd.jobs.store') }}" method="POST">
            @csrf
            <div class="card-body">
              {{-- Hidden HRD ID --}}
              <input type="hidden" name="hrd_id" value="{{ auth()->id() }}">

              <div class="form-group">
                <label for="posisi">Job Title</label>
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Enter job title" value="{{ old('posisi') }}" required>
              </div>

              <div class="form-group">
                <label for="nama_perusahaan">Company Name</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Enter company name" value="{{ old('nama_perusahaan') }}" required>
              </div>

              <div class="form-group">
                <label for="tempat_kerja">Location</label>
                <input type="text" class="form-control" id="tempat_kerja" name="tempat_kerja" placeholder="Enter location" value="{{ old('tempat_kerja') }}" required>
              </div>

              <div class="form-group">
                <label for="tipe_pekerjaan">Job Type</label>
                <select class="form-control" id="tipe_pekerjaan" name="tipe_pekerjaan" required>
                  <option value="">-- Select Type --</option>
                  <option value="full_time" @if(old('tipe_pekerjaan')=='full_time') selected @endif>Full-Time</option>
                  <option value="part_time" @if(old('tipe_pekerjaan')=='part_time') selected @endif>Part-Time</option>
                </select>
              </div>

              <div class="form-group">
                <label for="gaji">Monthly Salary</label>
                <input type="number" step="0.01" class="form-control" id="gaji" name="gaji" placeholder="Enter salary" value="{{ old('gaji') }}">
              </div>

              <div class="form-group">
                <label for="deskripsi_pekerjaan">Job Description</label>
                <textarea class="form-control" id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" rows="4" placeholder="Describe the job..." required>{{ old('deskripsi_pekerjaan') }}</textarea>
              </div>

              <div class="form-group">
                <label for="requirements">Requirements</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="4" placeholder="List the job requirements..." required>{{ old('requirements') }}</textarea>
              </div>

              <div class="form-group">
                <label for="expired_at">Expiration Date</label>
                <input type="date" class="form-control" id="expired_at" name="expired_at" value="{{ old('expired_at') }}">
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Create Job</button>
              <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
          </form>

        </div> <!-- /.card -->
      </div> <!-- /.col -->
    </section> <!-- /.content -->

  </div> <!-- /.content-wrapper -->

  @include('hrd.partials.footer')

</div> <!-- /.wrapper -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
