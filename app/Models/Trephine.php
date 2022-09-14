<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trephine extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trephinePhotos(){
        return $this->hasMany(TrephinePhoto::class);
    }
    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }

    public function specimenType(){
        return $this->belongsTo(SpecimenType::class);
    }

    // query scope local
    public function scopeSearch($q){
        if (isset(request()->name)){
            $name = request()->name;
            $q->where('patient_name','LIKE',"%$name%");
        }elseif (isset(request()->specimen_type)){
            $specimen_type = request()->specimen_type;
            $q->where('specimen_type_id','=',$specimen_type);
        }elseif(isset(request()->start_date)){
            $startDate = request()->start_date;
            $endDate = request()->end_date;
            $q->whereBetween('created_at', [$startDate, $endDate]);
        }
    }

}
