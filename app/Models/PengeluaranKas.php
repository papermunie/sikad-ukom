<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranKas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pengeluaran_kas';
    protected $primaryKey = 'kode_pengeluaran';
    protected $fillable = ['kode_pengeluaran', 'email_user', 
    'id_kategori_pengeluaran', 'tanggal_pengeluaran', 'jenis_pengeluaran'];

    public function kategoriPengeluaran()
    {
        return $this->belongsTo(kategoriPengeluaran::class, 'id_kategori_pengeluaran');
    }

    public function tblUser()
    {
        return $this->belongsTo(tblUserser::class, 'email_user');
    }
}
