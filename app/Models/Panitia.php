<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
    ];
    public function user(){
        return $this->hasOne(User::class);
    }
}
