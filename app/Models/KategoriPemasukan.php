<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPemasukan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pemasukan';
    protected $primaryKey = 'id_kategori_pemasukan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kategori_pemasukan',
        'jenis_pemasukan',
    ];
}
