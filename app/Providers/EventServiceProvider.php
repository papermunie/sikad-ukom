<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Observers\PemasukanKasObserver;
use App\Observers\PengeluaranKasObserver;
use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Observers\KategoriPemasukanObserver;
use App\Observers\KategoriPengeluaranObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LogActivity::class => [
            PemasukanKasObserver::class, 
            PengeluaranKasObserver::class,
            UserObserver::class,
            KategoriPemasukanObserver::class,
            KategoriPengeluaranObserver::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class,Observer::class);
        PemasukanKas::observe(PemasukanKasObserver::class,Observer::class);
        KategoriPemasukan::observe(KategoriPemasukanObserver::class,Observer::class);
        PengeluaranKas::observe(PengeluaranKasObserver::class,Observer::class); 
        KategoriPengeluaran::observe(KategoriPengeluaranObserver::class,Observer::class); 
    }
}
