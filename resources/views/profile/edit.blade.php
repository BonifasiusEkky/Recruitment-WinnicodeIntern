<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-picture-preview img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0d6efd;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    <div class="container">
        <div class="form-container">
            <h3>Edit Profile</h3>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="Male" {{ old('gender', $user->profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $user->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $user->profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Date of Birth</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $user->profile->tanggal_lahir ?? '') }}" required>
                    @error('tanggal_lahir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Address</label>
                    <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/jpeg,image/png,image/jpg">
                    @error('profile_picture')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @if ($user->profile && $user->profile->profile_picture)
                        <div class="profile-picture-preview mt-2">
                            <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Current Profile Picture">
                            <p>Current picture</p>
                        </div>
                    @else
                        <div class="profile-picture-preview mt-2">
                            <img src="https://via.placeholder.com/100/cccccc/969696?text=User" alt="Default Profile Picture">
                            <p>No picture uploaded</p>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>