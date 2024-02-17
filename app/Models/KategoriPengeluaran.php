<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengeluaran extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengeluaran';
    protected $primaryKey = 'id_kategori_pengeluaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kategori_pengeluaran',
        'jenis_pengeluaran',
    ];
}
