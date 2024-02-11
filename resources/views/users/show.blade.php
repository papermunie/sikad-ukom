<!DOCTYPE html>
<html>
<head>
    <title>User Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="container mt-5">
        <h1>User Detail</h1>
        <br> <br>
        <div class="row">
            <div class="col-md-4">
                @foreach(explode(',', $user->foto_profil) as $image)
                <img src="{{ asset('foto_profil/' . $user->foto_profil) }}" alt="Foto Profil" class="img-fluid" style="width: 600px">
                @endforeach
                <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Kembali</a>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $user->email_user }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Password</th>
                            <td>{{ $user->password }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Role</th>
                            <td>{{ $user->role }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
