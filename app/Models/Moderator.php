<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'instansi',
        'bio',
        'pengalaman',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
