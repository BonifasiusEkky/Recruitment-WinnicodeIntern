<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Job – {{ $job->posisi ?? 'Job' }}</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('hrd.partials.navbar')
  @include('hrd.partials.sidebar')

  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <h1>Edit Job</h1>
              <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('hrd.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('hrd.jobs.index') }}">Job Lists</a></li>
                  <li class="breadcrumb-item active">Edit</li>
              </ol>
          </div>
      </section>
      <br>

      <section class="content">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Edit Job: {{ $job->posisi }}</h3>
              </div>
              <div class="card-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <form action="{{ route('hrd.jobs.update', $job) }}" method="POST">
                      @csrf
                      @method('PATCH')

                      <div class="form-group">
                          <label for="posisi">Posisi</label>
                          <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $job->posisi) }}" required>
                      </div>

                      <div class="form-group">
                          <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                          <textarea name="deskripsi_pekerjaan" class="form-control" rows="4" required>{{ old('deskripsi_pekerjaan', $job->deskripsi_pekerjaan) }}</textarea>
                      </div>

                      <div class="form-group">
                          <label for="requirements">Requirements</label>
                          <textarea name="requirements" class="form-control" rows="4" required>{{ old('requirements', $job->requirements) }}</textarea>
                      </div>

                      <div class="form-group">
                          <label for="status">Status</label>
                          <select name="status" class="form-control">
                              <option value="1" {{ old('status', $job->status) == 1 ? 'selected' : '' }}>Active</option>
                              <option value="0" {{ old('status', $job->status) == 0 ? 'selected' : '' }}>Inactive</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="expired_at">Tanggal Berakhir</label>
                          <input type="date" name="expired_at" class="form-control" value="{{ old('expired_at', optional($job->expired_at)->format('Y-m-d')) }}">
                      </div>

                      <button type="submit" class="btn btn-primary">Update Job</button>
                      <a href="{{ route('hrd.jobs.index') }}" class="btn btn-secondary">Cancel</a>
                  </form>
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

</body>
</html>
