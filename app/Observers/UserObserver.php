<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserObserver
{
    public function created(User $user)
{
    $authenticatedUser = Auth::user();
    if ($authenticatedUser) {
        $transformedRole = $this->transformRole($authenticatedUser->role);
        $this->logActivity($transformedRole, 'Manajemen User', $user->email_user, 'created');
    } else {
        // Handle the case where there is no authenticated user
        // Maybe log an error or perform other actions as needed
        // For example:
        logger()->error('No authenticated user found when creating a new user.');
    }
}


    public function updated(User $user)
    {
        if ($user->isDirty('role')) {
            $transformedRole = $this->transformRole(Auth::user()->role);
            $this->logActivity($transformedRole, 'Manajemen User', $user->email_user, 'changed role to ' . $user->role);
        } else {
            $transformedRole = $this->transformRole(Auth::user()->role);
            $this->logActivity($transformedRole, 'Manajemen User', $user->email_user, 'updated');
        }
    }

    public function deleted(User $user)
    {
        $transformedRole = $this->transformRole(Auth::user()->role);
        $this->logActivity($transformedRole, 'Manajemen User', $user->email_user, 'deleted');
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
