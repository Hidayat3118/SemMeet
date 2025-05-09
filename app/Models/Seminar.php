<?php

namespace App\Models;

use App\Models\Panitia;
use App\Models\Voucher;
use App\Models\Kategori;
use App\Models\Keuangan;
use App\Models\Moderator;
use App\Models\Pembicara;
use App\Models\Testimoni;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $guarded = ['id'];

    public function testimoni (){
        return $this->hasMany(Testimoni::class);
    }

    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class);
    }

    public function voucher (){
        return $this->hasMany(Voucher::class);
    }
// perubahan
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function keuangan(){
        return $this->belongsTo(Keuangan::class);
    }

    public function panitia(){
        return $this->belongsTo(Panitia::class);
    }

    public function moderator(){
        return $this->belongsTo(Moderator::class,);
    }
// perubahan
    public function pembicara(){
        return $this->belongsTo(Pembicara::class);
    }
    
}
