<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill Document - CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @if (file_exists(public_path('css/style.css')))
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endif
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
        .document-link {
            color: #0d6efd;
            text-decoration: none;
        }
        .document-link:hover {
            text-decoration: underline;
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

        <!-- Main Content -->
        <div class="main-content">
            <h3>Fill Document</h3>
            <form action="{{ route('profile.fill-doc.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Curriculum Vitae -->
                <div class="document-section">
                    <label>Curriculum Vitae (Required)</label>
                    <div class="help-text">Upload your CV in PDF format with a maximum size of 2MB</div>
                    @if ($user->document && $user->document->curriculum_vitae)
                        <small id="cvStatus">
                            <a href="{{ asset('storage/' . $user->document->curriculum_vitae) }}" class="document-link" target="_blank">
                                {{ basename($user->document->curriculum_vitae) }}
                            </a>
                        </small>
                        <input type="file" name="curriculum_vitae" class="form-control-file d-none" id="cvInput" accept=".pdf">
                        <button type="button" class="btn-change" id="cvChange" onclick="document.getElementById('cvInput').click()">Change File</button>
                    @else
                        <small id="cvStatus">No file chosen</small>
                        <input type="file" name="curriculum_vitae" class="form-control-file d-none" id="cvInput" accept=".pdf">
                        <button type="button" class="btn-choose" onclick="document.getElementById('cvInput').click()">Choose File</button>
                        <button type="button" class="btn-change d-none" id="cvChange" onclick="document.getElementById('cvInput').click()">Change File</button>
                    @endif
                    @error('curriculum_vitae')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Transcript -->
                <div class="document-section">
                    <label>Transcript (Required)</label>
                    <div class="help-text">Upload your transcript in PDF format with a maximum size of 2MB</div>
                    @if ($user->document && $user->document->transcript)
                        <small id="transcriptStatus">
                            <a href="{{ asset('storage/' . $user->document->transcript) }}" class="document-link" target="_blank">
                                {{ basename($user->document->transcript) }}
                            </a>
                        </small>
                        <input type="file" name="transcript" class="form-control-file d-none" id="transcriptInput" accept=".pdf">
                        <button type="button" class="btn-change" id="transcriptChange" onclick="document.getElementById('transcriptInput').click()">Change File</button>
                    @else
                        <small id="transcriptStatus">No file chosen</small>
                        <input type="file" name="transcript" class="form-control-file d-none" id="transcriptInput" accept=".pdf">
                        <button type="button" class="btn-choose" onclick="document.getElementById('transcriptInput').click()">Choose File</button>
                        <button type="button" class="btn-change d-none" id="transcriptChange" onclick="document.getElementById('transcriptInput').click()">Change File</button>
                    @endif
                    @error('transcript')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ID Card -->
                <div class="document-section">
                    <label>ID Card (Required)</label>
                    <div class="help-text">Upload your ID card photo in PDF format with a maximum size of 2MB</div>
                    @if ($user->document && $user->document->id_card)
                        <small id="idCardStatus">
                            <a href="{{ asset('storage/' . $user->document->id_card) }}" class="document-link" target="_blank">
                                {{ basename($user->document->id_card) }}
                            </a>
                        </small>
                        <input type="file" name="id_card" class="form-control-file d-none" id="idCardInput" accept=".pdf">
                        <button type="button" class="btn-change" id="idCardChange" onclick="document.getElementById('idCardInput').click()">Change File</button>
                    @else
                        <small id="idCardStatus">No file chosen</small>
                        <input type="file" name="id_card" class="form-control-file d-none" id="idCardInput" accept=".pdf">
                        <button type="button" class="btn-choose" onclick="document.getElementById('idCardInput').click()">Choose File</button>
                        <button type="button" class="btn-change d-none" id="idCardChange" onclick="document.getElementById('idCardInput').click()">Change File</button>
                    @endif
                    @error('id_card')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Certificate -->
                <div class="document-section">
                    <label>Certificate of Organizational Experience (Optional)</label>
                    <div class="help-text">Upload your certificate with a maximum size of 5MB</div>
                    @if ($user->document && $user->document->certificate)
                        <small id="certificateStatus">
                            <a href="{{ asset('storage/' . $user->document->certificate) }}" class="document-link" target="_blank">
                                {{ basename($user->document->certificate) }}
                            </a>
                        </small>
                        <input type="file" name="certificate" class="form-control-file d-none" id="certificateInput" accept=".pdf">
                        <button type="button" class="btn-change" id="certificateChange" onclick="document.getElementById('certificateInput').click()">Change File</button>
                    @else
                        <small id="certificateStatus">No file chosen</small>
                        <input type="file" name="certificate" class="form-control-file d-none" id="certificateInput" accept=".pdf">
                        <button type="button" class="btn-choose" onclick="document.getElementById('certificateInput').click()">Choose File</button>
                        <button type="button" class="btn-change d-none" id="certificateChange" onclick="document.getElementById('certificateInput').click()">Change File</button>
                    @endif
                    @error('certificate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mengubah teks status file dan menampilkan tombol "Change File"
        function updateFileStatus(inputId, statusId, changeBtnId) {
            const input = document.getElementById(inputId);
            const status = document.getElementById(statusId);
            const changeBtn = document.getElementById(changeBtnId);
            const chooseBtn = input.previousElementSibling; // Tombol "Choose File"

            input.addEventListener('change', function() {
                if (input.files.length > 0) {
                    const file = input.files[0];
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2); // Ubah ke MB dengan 2 desimal
                    status.innerHTML = `${file.name} (${fileSizeMB} MB)`;
                    status.classList.remove('text-danger');
                    chooseBtn.classList.add('d-none');
                    changeBtn.classList.remove('d-none');
                } else {
                    status.innerHTML = 'No file chosen';
                    chooseBtn.classList.remove('d-none');
                    changeBtn.classList.add('d-none');
                }
            });
        }

        // Panggil fungsi untuk setiap input file
        updateFileStatus('cvInput', 'cvStatus', 'cvChange');
        updateFileStatus('transcriptInput', 'transcriptStatus', 'transcriptChange');
        updateFileStatus('idCardInput', 'idCardStatus', 'idCardChange');
        updateFileStatus('certificateInput', 'certificateStatus', 'certificateChange');
    </script>
</body>
</html>