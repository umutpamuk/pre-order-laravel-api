<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class UsersTest extends TestCase
{
    use WithFaker;


    /**
     * @return void
     */
    public function test_register() : void
    {
        $formData = [
            'name' => $this->faker->firstName . " " . $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];

        $this->post(route('register'), $formData)
            ->assertStatus(201);
    }


    /**
     * @return void
     */
    public function test_login() : void
    {
        $formData = [
            'email' => 'umutpamuk59@gmail.com',
            'password' => 'umutpamuk'
        ];

        $this->post(route('login'), $formData)
            ->assertStatus(200);
    }

}
