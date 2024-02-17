<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\ActivityLog;
use App\Models\KategoriPengeluaran;
use Illuminate\Support\Facades\Auth;

class KategoriPengeluaranObserver
{
    public function created(KategoriPengeluaran $kategoripengeluaran)
{
    $authenticatedUser = Auth::user();
    if ($authenticatedUser) {
        $transformedRole = $this->transformRole($authenticatedUser->role);
        $this->logActivity($transformedRole, 'Kategori Pengeluaran', $kategoripengeluaran->id_kategori_pengeluaran, 'created');
    } else {
        // Handle the case where there is no authenticated Pengeluaran
        // Maybe log an error or perform other actions as needed
        // For example:
        logger()->error('No authenticated user found when creating a new user.');
    }
}

    public function updated(KategoriPengeluaran $kategoripengeluaran)
    {
        if ($kategoripengeluaran->isDirty('role')) {
            $transformedRole = $this->transformRole(Auth::user()->role);
            $this->logActivity($transformedRole, 'Kategori Pengeluaran', $kategoripengeluaran->id_kategori_pengeluaran, 'changed role to ' . $kategoripengeluaran->role);
        } else {
            $transformedRole = $this->transformRole(Auth::user()->role);
            $this->logActivity($transformedRole, 'Kategori Pengeluaran', $kategoripengeluaran->id_kategori_pengeluaran, 'updated');
        }
    }

    public function deleted(KategoriPengeluaran $kategoripengeluaran)
    {
        $transformedRole = $this->transformRole(Auth::user()->role);
        $this->logActivity($transformedRole, 'Kategori Pengeluaran', $kategoripengeluaran->id_kategori_pengeluaran, 'deleted');
    }

    private function transformRole($role)
    {
        // Implementasi transformasi nama peran di sini
        // Contoh: 'KetuaDKM' menjadi 'Ketua DKM'
        $role = preg_replace('/(?<!\ )[A-Z]/', ' $0', $role);

        // Jika masih ada karakter non-alfabet yang tidak diinginkan,
        // Anda dapat menghapusnya atau menanganinya sesuai kebutuhan.
        // Contoh, menghapus karakter non-alfabet:
       // Hapus karakter _
    $role = str_replace('_', ' ', $role);

        // Terakhir, gunakan ucwords untuk mengonversi setiap kata menjadi huruf besar di awal
        return ucwords($role);
    }

    private function logActivity($auth, $entity, $entityId, $action)
    {
        ActivityLog::create([
            'auth' => $auth,
            'entity' => $entity,
            'entity_id' => $entityId,
            'action' => $action,
        ]);
    }
}
