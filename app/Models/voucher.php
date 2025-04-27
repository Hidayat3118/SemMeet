<?php

namespace App\Models;


use App\Models\Seminar;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    protected $guarded = ['id'];

    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class);
    }

    public function seminar (){
        return $this->belongsTo(Seminar::class);
    }

   
}
