<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Konsultasi;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'spesialisasi',
        'no_hp',
        'tanggal_lahir',
        'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class);
    }
}