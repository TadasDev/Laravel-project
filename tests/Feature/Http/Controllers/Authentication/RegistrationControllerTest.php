<?php

namespace Tests\Feature\Http\Controllers\Authentication;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user(): void
    {

        $response = $this->post(
                route('authentication.registration'),
                [
                    'email' => 'root@gmail.com ',
                    'first_name' => 'root',
                    'last_name' => 'rootings',
                    'phone' => +37086541257,
                    'city' => 'Kaunas',
                    'is_admin' => 1,
                    'password' => 'password',
                    'password_confirmation'=>'password'

                ]
            );

        $response->assertRedirect(route('dashboard'));
    }
}

