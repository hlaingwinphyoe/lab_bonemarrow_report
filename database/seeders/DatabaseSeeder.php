<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AspiratePhotoSeeder::class);
        $this->call(AspirateSeeder::class);

        $this->call(CytoPhotoSeeder::class);
        $this->call(CytoSeeder::class);
        $this->call(HistoGrossSeeder::class);
        $this->call(HistoPhotoSeeder::class);

        $this->call(HistoSeeder::class);
        $this->call(HospitalSeeder::class);
        $this->call(SpecimenTypeSeeder::class);
        $this->call(TrephinePhotoSeeder::class);
        $this->call(TrephineSeeder::class);

        User::create([
            'name' => "Hlaing Win Phyoe",
            'email' => "hlaingwinphyoedev@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('venom29502') ,
            'remember_token' => Str::random(10),
        ])->assignRole('Admin')->givePermissionTo(Permission::all());

    }
}
