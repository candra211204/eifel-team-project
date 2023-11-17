<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detailpesanan(){
        return $this->hasMany(Detailpesanan::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
