<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengeluaranKasController;
use App\Http\Controllers\PemasukanKasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\ActivityLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* --------------------------- JIKA URL-NYA KOSONG --------------------------- */
Route::get('/', function () {

  if (Auth::check()) {

    if (Auth::user()->role == "ketua_dkm") {
      return redirect('/users');
    } else if (Auth::user()->role == "bendahara") {
      return redirect('/bendahara');
    } else if (Auth::user()->role == "warga_sekolah") {
      return redirect('/pengunjung');
    }
  } else {
    return redirect('/home');
  }

});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/dasboard', [DasboardController::class, 'index'])->name('dasboard.dashboard');

/* -------------------------------- REGISTER -------------------------------- */
Route::get('register', [AuthController::class, 'register'])->name('user.register');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');

/* ---------------------------------- LOGIN --------------------------------- */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');

/* -------------------------------- PASSWORD -------------------------------- */
Route::get('password', [AuthController::class, 'password'])->name('password');
Route::post('password', [AuthController::class, 'password_action'])->name('password.action');

/* --------------------------------- LOGOUT --------------------------------- */
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


/* --------------------------------- BENDAHARA --------------------------------- */

// Route for displaying the login form
Route::get('/bendahara/login', [BendaharaController::class, 'bendaharalogin'])->name('bendahara.login');

// Route for processing the login form submission
Route::post('/bendahara/login', [BendaharaController::class, 'bendaharalogin_action'])->name('bendahara.login.action');

// Route for displaying the change password form
Route::get('/bendahara/password', [BendaharaController::class, 'bendaharapassword'])->name('bendahara.password');

// Route for processing the change password form submission
Route::post('/bendahara/password', [BendaharaController::class, 'bendaharapassword_action'])->name('bendahara.password.action');

// Route for logging out
Route::get('/bendahara/logout', [BendaharaController::class, 'bendaharalogout'])->name('bendahara.logout');
Route::get('/bendahara', [BendaharaController::class, 'pemasukanindex'])->name('bendahara.pemasukan.index');
Route::get('/bendahara/pemasukan', [BendaharaController::class, 'pemasukanindex'])->name('bendahara.pemasukan.index');
Route::get('/bendahara/pemasukan/create', [BendaharaController::class, 'pemasukancreate'])->name('bendahara.pemasukan.create');
Route::post('/bendahara/pemasukan/store', [BendaharaController::class, 'pemasukanstore'])->name('bendahara.pemasukan.store');
Route::get('/bendahara/pemasukan/{id}/edit', [BendaharaController::class, 'pemasukanedit'])->name('bendahara.pemasukan.edit');
Route::put('/bendahara/pemasukan/{id}/update', [BendaharaController::class, 'pemasukanupdate'])->name('bendahara.pemasukan.update');
Route::get('/bendahara/pemasukan/{id}/show', [BendaharaController::class, 'pemasukanshow'])->name('bendahara.pemasukan.show');
Route::delete('/bendahara/pemasukan/{id}/destroy', [BendaharaController::class, 'pemasukandestroy'])->name('bendahara.pemasukan.destroy');
Route::get('/bendahara/pengeluaran', [BendaharaController::class, 'pengeluaranindex'])->name('bendahara.pengeluaran.index');
Route::get('/bendahara/pengeluaran/create', [BendaharaController::class, 'pengeluarancreate'])->name('bendahara.pengeluaran.create');
Route::post('/bendahara/pengeluaran/store', [BendaharaController::class, 'pengeluaranstore'])->name('bendahara.pengeluaran.store');
Route::get('/bendahara/pengeluaran/{id}/edit', [BendaharaController::class, 'pengeluaranedit'])->name('bendahara.pengeluaran.edit');
Route::put('/bendahara/pengeluaran/{id}/update', [BendaharaController::class, 'pengeluaranupdate'])->name('bendahara.pengeluaran.update');
Route::get('/bendahara/pengeluaran/{id}/show', [BendaharaController::class, 'pengeluaranshow'])->name('bendahara.pengeluaran.show');
Route::delete('/bendahara/pengeluaran/{id}/destroy', [BendaharaController::class, 'pengeluarandestroy'])->name('bendahara.pengeluaran.destroy');
/* --------------------------------- WARGA SEKOLAH --------------------------------- */

Route::get('/pengunjung/register', [PengunjungController::class, 'pengunjungregister'])->name('pengunjung.register');
Route::post('/pengunjung/register', [PengunjungController::class, 'pengunjungregister_action'])->name('pengunjung.register.action');

Route::get('/pengunjung/login', [PengunjungController::class, 'pengunjunglogin'])->name('pengunjung.login');
Route::post('/pengunjung/login', [PengunjungController::class, 'pengunjunglogin_action'])->name('pengunjung.login.action');

Route::get('/pengunjung/password', [PengunjungController::class, 'pengunjungpassword'])->name('pengunjung.password');
Route::post('/pengunjung/password', [PengunjungController::class, 'pengunjungpassword_action'])->name('pengunjung.password.action');

Route::post('/pengunjung/logout', [PengunjungController::class, 'pengunjunglogout'])->name('pengunjung.logout');

/* ------------------------------- MIDDLEWARE ------------------------------- */
Route::prefix('/')->middleware('auth')->group(function () {
  Route::middleware(['auth'])->group(function () {
    /* -------------------------------- KETUA DKM ------------------------------- */
    Route::middleware(['isKetuaDkm'])->group(function () {

      Route::get('/users', [UserController::class, 'index'])->name('users.index');
      Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
      Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
      Route::get('/users/edit/{email_user}', [UserController::class, 'edit'])->name('users.edit');
      Route::get('/users/show/{email_user}', [UserController::class, 'show'])->name('users.show');
      Route::post('/users/update/{old_email_user}', [UserController::class, 'update'])->name('users.update');
      Route::delete('/users/destroy/{email_user}', [UserController::class, 'destroy'])->name('users.destroy');

    });

    /* -------------------------------- Bendahara ------------------------------- */
    Route::middleware(['isBendahara'])->group(function () {

      Route::get('/bendahara', [BendaharaController::class, 'pemasukanindex'])->name('bendahara.pemasukan.index');
      // return view('bendahara.login', $data);
    });

    /* ---------------------- UNTUK KETUA DKM DAN BENDAHARA --------------------- */
    Route::middleware(['KetuaDkmOrBendahara'])->group(function () {
      // pengeluaran
      Route::get('/pengeluaran', [PengeluaranKasController::class, 'index'])->name('pengeluaran.index');
      Route::get('/pengeluaran/create', [PengeluaranKasController::class, 'create'])->name('pengeluaran.create');
      Route::post('/pengeluaran', [PengeluaranKasController::class, 'store'])->name('pengeluaran.store');
      Route::get('/pengeluaran/{id}', [PengeluaranKasController::class, 'show'])->name('pengeluaran.show');
      Route::get('/pengeluaran/{id}/edit', [PengeluaranKasController::class, 'edit'])->name('pengeluaran.edit');
      Route::put('/pengeluaran/{id}', [PengeluaranKasController::class, 'update'])->name('pengeluaran.update');
      Route::delete('/pengeluaran/{id}', [PengeluaranKasController::class, 'destroy'])->name('pengeluaran.destroy');

      // pemasukan
      Route::get('/pemasukan', [PemasukanKasController::class, 'index'])->name('pemasukan.index');
      Route::get('/pemasukan/create', [PemasukanKasController::class, 'create'])->name('pemasukan.create');
      Route::post('/pemasukan', [PemasukanKasController::class, 'store'])->name('pemasukan.store');
      Route::get('/pemasukan/{id}', [PemasukanKasController::class, 'show'])->name('pemasukan.show');
      Route::get('/pemasukan/{id}/edit', [PemasukanKasController::class, 'edit'])->name('pemasukan.edit');
      Route::put('/pemasukan/{id}', [PemasukanKasController::class, 'update'])->name('pemasukan.update');
      Route::delete('/pemasukan/{id}', [PemasukanKasController::class, 'destroy'])->name('pemasukan.destroy');

      /* Log */
      Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    });

    /* ------------------------------- PENGUNJUNG ------------------------------- */
    Route::middleware(['isPengunjung'])->group(function () {
      Route::get('/pengunjung', [PengunjungController::class, 'index'])->name('pengunjung.pengunjungg');
      Route::get('/laporan', [PengunjungController::class, 'laporan'])->name('laporan.index');
      Route::get('/laporanmasuk', [PengunjungController::class, 'laporanmasuk'])->name('pengunjung.laporanmasuk');
      Route::get('/laporankeluar', [PengunjungController::class, 'laporankeluar'])->name('pengunjung.laporankeluar');
    });
  });
});

// store prosedure
Route::get("list-tbluser", [HomeController::class, "ListTblUser"]);
Route::get("get-tbluser/{id}", [HomeController::class, "singleTblUser"]);