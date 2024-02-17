<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\ActivityLog;
use App\Models\PengeluaranKas;
use Illuminate\Support\Facades\Auth;

class PengeluaranKasObserver
{
    public function created(PengeluaranKas $pengeluarankas)
{
    $authenticatedUser = Auth::user();
    if ($authenticatedUser) {
        $transformedRole = $this->transformRole($authenticatedUser->role);
        $this->logActivity($transformedRole, 'Pengeluaran Kas', $pengeluarankas->kode_pengeluaran, 'created');
    } else {
        // Handle the case where there is no authenticated Pengeluaran
        // Maybe log an error or perform other actions as needed
        // For example:
        logger()->error('No authenticated user found when creating a new user.');
    }
}

    public function updated(PengeluaranKas $pengeluarankas)
    {
        if ($pengeluarankas->isDirty('role')) {
            $transformedRole = $this->transformRole(Auth::user()->role);
            $this->logActivity($transformedRole, 'Pengeluaran Kas', $pengeluarankas->kode_pengeluaran, 'changed role to ' . $pengeluarankas->role);
        } else {
            $transformedRole = $this->transformRole(Auth::user()->role);
            $this->logActivity($transformedRole, 'Pengeluaran Kas', $pengeluarankas->kode_pengeluaran, 'updated');
        }
    }

    public function deleted(PengeluaranKas $pengeluarankas)
    {
        $transformedRole = $this->transformRole(Auth::user()->role);
        $this->logActivity($transformedRole, 'Pengeluaran Kas', $pengeluarankas->kode_pengeluaran, 'deleted');
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
