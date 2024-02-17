<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['auth','entity', 'entity_id', 'action'];

    // Format tanggal untuk ditampilkan
    protected $dates = ['created_at', 'updated_at'];

    // Relasi polimorfik untuk menghubungkan dengan entitas lain jika diperlukan
    public function subject()
    {
        return $this->morphTo('auth', 'entity', 'entity_id');
    }

    // Metode untuk mendapatkan entitas terkait sebagai string
    public function getEntityStringAttribute()
    {
        // Misalnya, ambil nama user jika entitasnya User
        return $this->subject ? $this->subject->name : 'Unknown Entity';
    }

    // Metode untuk mendapatkan deskripsi aktivitas log
    public function getDescriptionAttribute()
    {
        return "{$this->action} {$this->entity} '{$this->entity_string}'";
    }

    // Metode atau properti tambahan sesuai kebutuhan
}