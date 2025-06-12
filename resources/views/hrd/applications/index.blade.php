<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job Lists – {{ $companyName ?? 'CompanyJob' }}</title>

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
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">Daftar Lamaran</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <table id="applicationTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Pelamar</th>
                  <th>Posisi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              @forelse ($applications as $application)
                  <tr>
                    <td>{{ $application->user ? $application->user->name : 'Tidak ada data pelamar' }}</td>
                    <td>{{ $application->job ? $application->job->posisi : 'Tidak ada data posisi' }}</td>
                    <td>{{ $application->status ?? 'Tidak ada status' }}</td>
                    <td>
                      <a href="{{ route('hrd.applications.show', $application->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> Lihat Detail
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center">Tidak ada lamaran yang ditemukan.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
    $('#applicationTable').DataTable({
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
