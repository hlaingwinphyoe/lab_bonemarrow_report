<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecimenType extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function aspirates(){
        return $this->hasMany(Aspirate::class);
    }

    public function trephines(){
        return $this->hasMany(Trephine::class);
    }

    public function histos(){
        return $this->hasMany(Histo::class);
    }

    public function cytos(){
        return $this->hasMany(Cyto::class);
    }

}
