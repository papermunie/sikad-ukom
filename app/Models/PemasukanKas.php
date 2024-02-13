<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanKas extends Model
{
    use HasFactory;

    protected $table = 'pemasukan_kas';

    protected $primaryKey = 'kode_pemasukan';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'kode_pemasukan',
        'jenis_pemasukan',
        'tanggal_pemasukan',
        'jumlah_pemasukan',
        'dokumentasi',
    ];

    protected $casts = [
        'tanggal_pemasukan' => 'date',
    ];
    
}