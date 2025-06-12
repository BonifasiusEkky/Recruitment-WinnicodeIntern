<!DOCTYPE html>
<html>
<head>
    <title>Edit Pekerjaan - CompanyJob</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Edit Pekerjaan</h2>
        <form action="{{ route('jobs.update', $job->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="posisi" class="block text-sm font-medium">Posisi</label>
                <input type="text" name="posisi" id="posisi" value="{{ $job->posisi }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="gaji" class="block text-sm font-medium">Gaji</label>
                <input type="text" name="gaji" id="gaji" value="{{ $job->gaji }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full p-2 border rounded" required>{{ $job->deskripsi }}</textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Perbarui</button>
        </form>
    </div>
</body>
</html>