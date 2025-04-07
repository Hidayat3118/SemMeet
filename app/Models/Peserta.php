<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $fillable = [
        'alamat',
        'instansi',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
