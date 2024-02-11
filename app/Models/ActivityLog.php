<?php
use App\Models\ActivityLog;

class PemasukanKas extends Model
{
    protected $dispatchesEvents = [
        'created' => PemasukanKasCreated::class,
        'updated' => PemasukanKasUpdated::class,
        'deleted' => PemasukanKasDeleted::class,
    ];
}

class PengeluaranKas extends Model
{
    protected $dispatchesEvents = [
        'created' => PengeluaranKasCreated::class,
        'updated' => PengeluaranKasUpdated::class,
        'deleted' => PengeluaranKasDeleted::class,
    ];
}
