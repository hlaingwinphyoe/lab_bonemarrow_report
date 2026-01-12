<?php

namespace Database\Seeders;

use App\Models\ClinicInfo;
use Illuminate\Database\Seeder;

class ClinicInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clinicInfo = ClinicInfo::create([
            'name' => 'Cellular Pathology',
            'address' => "Mandalay, Myanmar",
            'logo' => "",
        ]);

        $clinicInfo->clinic_phones()->create([
            'phone' => '09974478264',
        ]);

        $clinicInfo->clinic_phones()->create([
            'phone' => '0933763367',
        ]);
    }
}
