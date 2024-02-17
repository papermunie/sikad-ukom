<!-- resources/views/users/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->email_user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}
            <div class="mb-3">
                <label for="email_user" class="form-label">Email:</label>
                <div class="input-group mb-3">
                <input type="text" class="form-control" id="email_user" name="email_user" value="{{ $user->email_user }}" required>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@gmail.com</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}" required>
            </div>
            

            <div class="mb-3">
                <label for="foto_profil" class="form-label">Profile Picture:</label>
                <br>
                <img src="{{ url('foto_profil') . '/' . $user->foto_profil }}" style="width: 200px; height: 250px;" alt="Profile" />
                <input type="file" name="foto_profil" id="foto_profil" class="form-control mt-3">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select class="form-select" id="role" name="role">
                    <option value="ketua_dkm" @if($user->role == 'ketua_dkm') selected @endif>Ketua DKM</option>
                    <option value="bendahara" @if($user->role == 'bendahara') selected @endif>Bendahara</option>
                    <option value="warga_sekolah" @if($user->role == 'warga_sekolah') selected @endif>Warga Sekolah</option>
                </select>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
