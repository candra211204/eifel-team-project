<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pesanan(){
        return $this->belongsTo(Pesanan::class);
    }

    public function buku(){
        return $this->belongsTo(Buku::class);
    }
}
