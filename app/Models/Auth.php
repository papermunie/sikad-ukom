<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'email_user'; // Define the primary key

    protected $keyType = 'string'; // Define the key type

    public $incrementing = false; // Disable auto-incrementing for primary key

    protected $fillable = [
        'email_user',
        'password',
        'foto_profil',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
