<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        User::create([
            'name' => "Hlaing Win Phyoe",
            'email' => "hlaingwinphyoedev@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('venom29502') ,
            'role' => '0',
            'remember_token' => Str::random(10),
        ]);

    }
}
