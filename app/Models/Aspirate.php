<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirate extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function aspiratePhotos(){
        return $this->hasMany(AspiratePhoto::class);
    }
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }

}
