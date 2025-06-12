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
        <h1 class="m-0 text-dark">Detail Lamaran</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            <p><strong>Pelamar:</strong> {{ $application->user ? $application->user->name : 'Tidak ada data pelamar' }}</p>
            <p><strong>Email:</strong> {{ $application->user ? $application->user->email : 'Tidak ada data email' }}</p>
            <p><strong>Posisi Dilamar:</strong> {{ $application->job ? $application->job->posisi : 'Tidak ada data posisi' }}</p>
            <p><strong>Status Lamaran:</strong> {{ $application->status ?? 'Tidak ada status' }}</p>

            <!-- Form untuk mengupdate status -->
            <form action="{{ route('hrd.applications.updateStatus', $application->id) }}" method="POST">
              @csrf
              @method('POST')
              <div class="form-group">
                <label for="status">Ubah Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                  <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                  <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Simpan Status</button>
            </form>
          </div>
        </div>

        <div class="card mt-4">
          <div class="card-header">
            <h3 class="card-title">Dokumen Pelamar</h3>
          </div>
          <div class="card-body">
          @if ($documents->isNotEmpty())
              @foreach ($documents as $document)
                @if ($document->curriculum_vitae)
                  <div class="mb-2">
                    <a href="{{ asset('storage/' . $document->curriculum_vitae) }}" target="_blank" class="btn btn-sm btn-info">
                      <i class="fas fa-file"></i> Curriculum Vitae
                    </a>
                  </div>
                @endif
                @if ($document->transcript)
                  <div class="mb-2">
                    <a href="{{ asset('storage/' . $document->transcript) }}" target="_blank" class="btn btn-sm btn-info">
                      <i class="fas fa-file"></i> Transcript
                    </a>
                  </div>
                @endif
                @if ($document->id_card)
                  <div class="mb-2">
                    <a href="{{ asset('storage/' . $document->id_card) }}" target="_blank" class="btn btn-sm btn-info">
                      <i class="fas fa-file"></i> ID Card
                    </a>
                  </div>
                @endif
                @if ($document->certificate)
                  <div class="mb-2">
                    <a href="{{ asset('storage/' . $document->certificate) }}" target="_blank" class="btn btn-sm btn-info">
                      <i class="fas fa-file"></i> Certificate
                    </a>
                  </div>
                @endif
              @endforeach
            @else
              <p>Tidak ada dokumen yang tersedia.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
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
