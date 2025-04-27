<?php

namespace App\Models;

use App\Models\Seminar;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $guarded = ['id'];

    public function seminar (){
        return $this->belongsTo(Seminar::class);
    }
}
