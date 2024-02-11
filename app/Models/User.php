<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'tbl_user';
    protected $primaryKey = 'email_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'email_user',
        'password',
        'foto_profil',
        'role',
    ];

    // Required methods from Authenticatable contract

    public function getAuthIdentifierName()
    {
        return 'email_user'; // or any other column name you're using as the identifier
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->getAttribute('password');
    }

    public function getRememberToken()
    {
        return $this->getAttribute('remember_token');
    }

    public function setRememberToken($value)
    {
        $this->setAttribute('remember_token', $value);
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
