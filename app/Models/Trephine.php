<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trephine extends Model
{
    use HasFactory;

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trephinePhotos(){
        return $this->hasMany(TrephinePhoto::class);
    }
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }

}
