@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{asset('process.png')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Navbar */
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #C5C5F1; /* Warna biru pastel */
            padding: 8px 16px; /* Padding atas dan bawah */
            position: relative; 
        }
        .navbar-nav {
            width: 100%; /* Mengisi lebar navbar */
            justify-content: center; /* Membuat seluruh item berada di tengah-tengah */
            position: relative; 
        }
        /* Custom styling for nav links */
        .navbar-nav .nav-link {
            padding: 12px 16px; /* Padding atas dan bawah 12px, kiri dan kanan 16px */
            margin: 0 80px; /* Margin kiri dan kanan 8px */
        }

        /* Custom styling for hover effect */
        .navbar-nav .nav-link:hover {
            background-color: #A0A0F3; /* Warna hover biru lebih terang */
            color: black;
        }
        .logout-button {
            background-color: red; /* Warna merah */
            color: white; /* Warna teks putih */
            border: none; /* Hapus border */
            padding: 8px 16px; /* Padding tombol */
            position: absolute; /* Menjadikan posisi absolut */
            top: 50%; /* Meletakkan pada posisi vertikal tengah */
            transform: translateY(-50%); /* Menggeser ke atas sebesar setengah dari tinggi tombol */
            right: 16px;
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    @section('navbar')
        <!-- Bootstrap Navbar -->
        <nav class="navbar navbar-expand-lg justify-content-center">
        <div class="container-fluid justify-content-center">
                <!-- Navbar brand/logo -->
                <a class="navbar-brand" href="{{ route('home.index') }}">SIKAD</a>
                
                <!-- Toggler/collapsing button for small screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-center">
                  
                        <li class="nav-item">
                           <b> <a class="nav-link" href="{{ route('bendahara.pemasukan.index') }}">Pemasukan</a> </b>
                        </li>
                        <li class="nav-item">
                         <b>   <a class="nav-link" href="{{ route('bendahara.pengeluaran.index') }}">Pengeluaran</a></b>
                        </li>
                        <li class="nav-item">
                           <b> <a class="nav-link" href="{{ route('log.index') }}">Logs</a></b>
                        </li>
                    </ul>
                </div>
                <b> <button class="logout-button"><a href="{{ route('bendahara.logout') }}" style="color:rgb(0, 0, 0); text-decoration: none;">Logout</a></button> </b>
            </div>
    </div>
        </nav>
    @show <!-- end of Navbar Section -->

    <!-- Content Section -->
    <div id="app">
        @yield('content')

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@yield('footer')
<script>
    // window.setTimeout(function () {
    //     $(".alert").fadeTo(500, 0).slideUp(500, function () {
    //         $(this).remove();
    //     });
    // }, 3000);
</script>
</body>
</html>
