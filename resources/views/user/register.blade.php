<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; 
            margin: 0;
            flex-direction: column;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card {
            background-color: #C5C5F1;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px; 
            width: 90%; 
            max-width: 600px; 
        }

        .form-control {
            border-radius: 5px;
            margin-bottom: 15px;
            width: 100%;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .btn-primary {
            background-color: #FDD4B6;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: black;
            font-weight: bold;
        }

    </style>
</head>
<body>

    <div class="title mb-4">{{ __('Silahkan Register') }}</div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <form action="{{ route('register.action') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="email_user" class="form-label">Email:</label>
            <div class="input-group mb-0">
                <input type="text" class="form-control" id="email_user" name="email_user" required>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@gmail.com</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="foto_profil" class="form-label">Profile Picture:</label>
                <input type="file" class="form-control" name="foto_profil" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select class="form-select" name="role" required>
                    <option value="ketua_dkm">Ketua DKM</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="warga_sekolah">Warga Sekolah</option>
                </select>
            </div>

            <a href="{{ route('login') }}">Klik di sini untuk login</a>

           
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
        


    </div>

    <!-- Add Bootstrap JS and dependencies if needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
