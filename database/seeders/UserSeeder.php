<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

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
            'name' => "Umut Pamuk",
            'email' => 'umutpamuk59@gmail.com',
            'password' => Hash::make("umutpamuk"),
            'role' => 'admin',
            ]);

        $user = User::first();

        PersonalAccessToken::create([
            'tokenable_type' => get_class($user),
            'tokenable_id' => $user->id,
            'name' => 'API TOKEN',
            'token' => '6fff2fdd38b31a4fbf02bfb27732523cec165daa082c7d46610bfa2a19b66f65',
            'abilities' => ["*"],
        ]);

        User::create([
            'name' => "Ömer Şahinler",
            'email' => 'omersahinler@gmail.com',
            'password' => Hash::make("omersahinler"),
            'role' => 'user',
            ]);
    }
}
