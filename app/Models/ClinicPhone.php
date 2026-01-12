<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicPhone extends Model
{
    protected $table = 'clinic_phones';

    protected $guarded = [];

    public function clinicInfo(): BelongsTo
    {
        return $this->belongsTo(ClinicInfo::class);
    }
}
