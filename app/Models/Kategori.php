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
        return $this->belongsToMany(Seminar::class, 'seminar_kategori');
    }

    public function moderators(){
        return $this->belongsToMany(Moderator::class, 'moderator_kategori');
    }

    public function pembicaras(){
        return $this->belongsToMany(Pembicara::class, 'pembicara_kategori');
    }


}
