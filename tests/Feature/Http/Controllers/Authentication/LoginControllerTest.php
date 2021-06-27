<?php

namespace Tests\Feature\Http\Controllers\Authentication;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_logins_with_user_and_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post(
            route('authentication.login'),
            [
                'email' => $user->email,
                'password' => 'password'
            ],
        );

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('dashboard'));
    }

    /**
     * @param callable $getCredentials
     *
     * @dataProvider dataProviderFailedAuthentication
     */
    public function test_does_not_authenticate_with_wrong_password(callable $getCredentials): void
    {
        $this->post(
            route('authentication.login'),
            $getCredentials()
        );

        $this->assertGuest();
    }

    public function dataProviderFailedAuthentication(): array
    {
        return [
            'fails to authenticate with wrong email' => [
                function () {
                    User::factory()->create();

                    return [
                        'email' => 'any_mail@gmail.com',
                        'password' => 'password'
                    ];
                }
            ],
            'fails to authenticate with wrong password' => [
                function () {
                    $user = User::factory()->create();

                    return [
                        'email' => $user->email,
                        'password' => 'password'
                    ];
                }
            ],
        ];
    }
}
