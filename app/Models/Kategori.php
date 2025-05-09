<?php

namespace App\Models;

use App\Models\Seminar;
use App\Models\Moderator;
use App\Models\Pembicara;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = ['id'];

    public function seminars()
    {
        return $this->hasMany(Seminar::class);
    }

    public function moderator(){
        return $this->belongsToMany(Moderator::class);
    }

    public function pembicara(){
        return $this->belongsToMany(Pembicara::class);
    }


}
