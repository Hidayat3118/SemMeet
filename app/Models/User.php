<?php

namespace App\Models;

use App\Models\Panitia;
use App\Models\Peserta;
use App\Models\Keuangan;
use App\Models\Moderator;
use App\Models\Pembicara;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;


    public function peserta()
    {
        return $this->hasOne(Peserta::class);
    }
    public function panitia()
    {
        return $this->hasOne(Panitia::class);
    }
    public function pembicara()
    {
        return $this->hasOne(Pembicara::class);
    }
    public function moderator()
    {
        return $this->hasOne(Moderator::class);
    }
    public function keuangan()
    {
        return $this->hasOne(Keuangan::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
