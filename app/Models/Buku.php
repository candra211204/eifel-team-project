<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function detailpesanan(){
        return $this->hasMany(Detailpesanan::class);
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class);
    }
}
