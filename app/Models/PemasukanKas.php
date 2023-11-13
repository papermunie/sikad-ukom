<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanKas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pemasukan_kas';
    protected $primaryKey = 'kode_pemasukan';
    protected $fillable = ['kode_pemasukan', 'email_user', 
    'id_kategori_pemasukan', 'tanggal_pemasukan', 'jenis_pemasukan'];

    public function kategoripemasukan()
    {
        return $this->belongsTo(kategoripemasukan::class, 'id_kategori_pemasukan');
    }

    public function tblUser()
    {
        return $this->belongsTo(tblUserser::class, 'email_user');
    }
}
