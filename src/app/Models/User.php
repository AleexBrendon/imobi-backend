<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isFuncionario()
    {
        return $this->role === 'funcionario';
    }

    public function isUsuario()
    {
        return $this->role === 'usuario';
    }
    
}
