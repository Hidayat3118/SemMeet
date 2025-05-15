<?php

namespace App\Models;

use App\Models\Karcis;
use App\Models\Payment;
use App\Models\Peserta;
use App\Models\Seminar;
use App\Models\Voucher;
use App\Models\Sertifikat;
use Illuminate\Database\Eloquent\Model;
use Pest\Mutate\Mutators\Visibility\FunctionPublicToProtected;

class Pendaftaran extends Model
{
    protected $guarded = ['id'];


    public function karcis(){
        return $this->hasOne(Karcis::class);
    }

    public function voucher(){
        return $this->belongsTo(Voucher::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function sertifikat(){
        return $this->hasOne(Sertifikat::class);
    }

    public function seminar() {
        return $this->belongsTo(Seminar::class);
    }

    public function peserta(){
        return $this->belongsTo(Peserta::class);
    }
}
