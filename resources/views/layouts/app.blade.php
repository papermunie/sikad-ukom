@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
<!-- Jangan lupa untuk memuat jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var currentUrl = window.location.href;

        // Memeriksa setiap navlink
        $(".navbar-nav a").each(function() {
            var navUrl = $(this).attr("href");

            // Jika URL dari navlink sesuai dengan URL saat ini
            if (currentUrl.includes(navUrl)) {
                $(this).addClass("active"); // Tambahkan kelas aktif
            }
        });
    });
</script>

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
            padding: 2px 16px; /* Padding atas dan bawah */
            position: relative; 
        }
        .navbar-nav {
            width: 100%; /* Mengisi lebar navbar */
            justify-content: center; /* Membuat seluruh item berada di tengah-tengah */
            position: relative; 
        }

        .navbar-nav .nav-link {
            padding: 12px 16px; 
            margin: 0 80px;
        }

        .navbar-nav .nav-link:hover {
            background-color: #A0A0F3; 
            color: black;
        }
        .nav-item a.active {
    background-color: #A0A0F3; /* Warna latar belakang untuk navlink aktif */
    color: black; /* Warna teks untuk navlink aktif */
}

        .logout-button {
            background-color: red;
            color: rgb(0, 0, 0); 
            border: none; 
            padding: 8px 16px; 
            position: absolute; 
            margin-top: 0px;
            margin-bottom:0px 
            transform: translateY(-50%);
            right: 16px;

        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    @section('navbar')
        <nav class="navbar navbar-expand-lg justify-content-center">
        <div class="container-fluid justify-content-center">
                <!-- Navbar brand/logo -->
                <a class="navbar-brand" href="{{ route('home.index') }}">SIKAD</a>
           
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
        
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-center">
                        <li class="nav-item justify-content-center">
                          <b>  <a class="nav-link" href="{{ route('users.index') }}">User</a></b>
                        </li>
                        <li class="nav-item">
                           <b> <a class="nav-link" href="{{ route('pemasukan.index') }}">Pemasukan</a> </b>
                        </li>
                        <li class="nav-item">
                         <b>   <a class="nav-link" href="{{ route('pengeluaran.index') }}">Pengeluaran</a></b>
                        </li>
                        <li class="nav-item"> 
                          <b> <a class="nav-link" href="{{ route('activity_logs.index') }}">Logs</a></b>
                         </li> 
                    </ul>
                    @if(Auth::check()) <!-- Cek apakah pengguna sedang login -->
    <span class="navbar-text" style="display: flex; align-items: center;">
        <img src="{{ asset('user.png') }}" width='50px' style="margin-right: 10px;">
        <b>
            @php
                $role = Auth::user()->role; // Ambil nilai peran pengguna
                switch($role) {
                    case 'ketua_dkm':
                        echo 'Ketua DKM';
                        break;
                    case 'bendahara':
                        echo 'Bendahara';
                        break;
                    case 'warga_sekolah':
                        echo 'Warga Sekolah';
                        break;
                    default:
                        echo $role; // Jika tidak cocok, tampilkan nilai peran langsung
                        break;
                }
            @endphp
        </b>
    </span>
@endif
            </nav>
<!-- Memindahkan tombol logout ke bawah navbar -->
<div class="d-flex justify-content-center" style="margin-top: 10px;">
    <b> <button class="logout-button"><a href="{{ route('logout') }}" style="color:rgb(0, 0, 0); text-decoration: none;">Logout</a></button> </b>
</div>

                </div>
            
            </div>
    </div>
        
    @show 

    <div id="app">
        @yield('content')

    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@yield('footer')

</body>
</html>