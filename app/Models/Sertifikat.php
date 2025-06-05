<?php

namespace App\Models;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $guarded = ['id'];

    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class);
    }
}
