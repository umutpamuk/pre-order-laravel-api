<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Umut",
            'email' => "Pamuk",
            'password' => Hash::make("umutpamuk"),
            'role' => 'admin',
            ]);

        User::create([
            'name' => "Ömer",
            'email' => "Şahinler",
            'password' => Hash::make("omersahinler"),
            'role' => 'user',
            ]);
    }
}
