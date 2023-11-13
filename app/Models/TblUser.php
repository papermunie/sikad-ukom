<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TblUser extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'tbl_user';
    protected $primaryKey = 'email_user';
    protected $fillable = ['email_user', 'password', 'foto_profil', 'role'];
    public $timestamps = false;
    protected $hidden = ['password'];
}
