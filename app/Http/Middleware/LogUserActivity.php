<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Catat aktivitas jika pengguna telah terotentikasi
        if (Auth::check()) {
            $user = Auth::user();

            // Catat aktivitas CRUD
            $activity = $this->getActivityName($request->method());

            // Simpan log aktivitas ke database
            ActivityLog::create([
                'user_id' => $user->id,
                'activity' => $activity,
                'route' => $request->path() // Contoh menambahkan informasi route
            ]);
        }

        return $response;
    }

    private function getActivityName($method)
    {
        switch ($method) {
            case 'POST':
                return 'created';
            case 'GET':
                return 'read';
            case 'PUT':
            case 'PATCH':
                return 'updated';
            case 'DELETE':
                return 'deleted';
            default:
                return 'performed';
        }
    }
}
