<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClinicInfo extends Model
{
    protected $table = 'clinic_infos';

    protected $guarded = [];

    public function clinic_phones(): HasMany
    {
        return $this->hasMany(ClinicPhone::class);
    }

    // public function logo(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($value, $attributes) {
    //             return $attributes['logo']
    //                 ? asset('storage/' . $attributes['logo'])
    //                 : null;
    //         }
    //     );
    // }
}
