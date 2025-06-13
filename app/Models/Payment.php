<?php

namespace App\Models;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class);
    }

    public function voucher()
{
    return $this->belongsTo(Voucher::class);
}

}
