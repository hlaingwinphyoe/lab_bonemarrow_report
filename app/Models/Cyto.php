<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cyto extends Model
{
    use HasFactory;

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cytoPhotos(){
        return $this->hasMany(CytoPhoto::class);
    }
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }

}
