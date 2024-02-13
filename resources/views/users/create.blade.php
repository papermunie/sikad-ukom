<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create User</h1>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="email_user" class="form-label">Email:</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="email_user" name="email_user" required>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@gmail.com</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <label>Foto</label>
            <input type="file" class="form-control mb-3" id="Foto" name="foto_profil" required>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="ketua_dkm">Ketua DKM</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="warga_sekolah">Warga Sekolah</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
