<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job Detail – {{ $job->posisi ?? 'Job' }}</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('hrd.partials.navbar')
  @include('hrd.partials.sidebar')

  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <h1>Job Detail</h1>
              <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('hrd.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('hrd.jobs.index') }}">Job Lists</a></li>
                  <li class="breadcrumb-item active">Detail</li>
              </ol>
          </div>
      </section>
<br>
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">{{ $job->posisi }}</h3>
              </div>
              <div class="card-body">
                  <p><strong>Posisi:</strong> {{ $job->posisi }}</p>
                  <p><strong>Deskripsi:</strong> {!! nl2br(e($job->deskripsi_pekerjaan)) !!}</p>
                  <p><strong>Requirements:</strong> {!! nl2br(e($job->requirements)) !!}</p>
                  <p><strong>Status:</strong> {{ $job->status ? 'Active' : 'Inactive' }}</p>
                  <p><strong>Tanggal Dibuat:</strong> {{ $job->created_at->format('Y-m-d') }}</p>
                  <p><strong>Tanggal Berakhir:</strong> {{ optional($job->expired_at)->format('Y-m-d') ?? '-' }}</p>
              </div>
              <div class="card-footer">
                  <a href="{{ route('hrd.jobs.edit', $job) }}" class="btn btn-primary">Edit Job</a>
                  <a href="{{ route('hrd.jobs.index') }}" class="btn btn-secondary">Back to List</a>
              </div>
          </div>
      </section>
  </div>

  @include('hrd.partials.footer')
</div><!-- /.wrapper -->

<!-- jQuery, Bootstrap, AdminLTE -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

<script>
  $(function() {
    $('#jobsTable').DataTable({
      responsive: true,
      autoWidth: false,
      lengthChange: true,
      pageLength: 10,
      order: [[2, 'desc']],
      dom:
        "<'row mb-3'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>",
      language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        paginate: {
          previous: "Previous",
          next: "Next"
        },
        info: "Showing _START_ to _END_ of _TOTAL_ entries"
      }
    });
  });
</script>
</body>
</html>
