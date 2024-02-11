<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranKas extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_kas';

    protected $primaryKey = 'kode_pengeluaran';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'kode_pengeluaran',
        'jenis_pengeluaran',
        'tanggal_pengeluaran',
        'jumlah_pengeluaran',
        'dokumentasi',
    ];

    protected $casts = [
        'tanggal_pengeluaran' => 'date',
    ];
}