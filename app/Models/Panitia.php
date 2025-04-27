<?php

namespace App\Models;

use App\Models\Seminar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panitia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function user(){
        return $this->hasOne(User::class);
    }

    public function seminar(){
        return $this->hasMany(Seminar::class);
    }
}
