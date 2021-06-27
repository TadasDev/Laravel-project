<?php

namespace Tests\Feature\Http\Controllers;

use Mockery;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Mockery\MockInterface;
use App\Service\PostMailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_stores_post(): void
    {
        // Arrange
        $user = User::factory()->create();
        $this->be($user);

        $category = Category::factory()->create();

        $this->instance(
            PostMailService::class,
            Mockery::mock(PostMailService::class, function (MockInterface $mock) {
                $mock->shouldReceive('informUserPostCreated')->once();
            })
        );

        // Act
        $response = $this->post(
            route('posts.store'),
            [
                'title' => 'testTitle',
                'description' => 'testDescription',
                'price' => 15,
                'category_id' => $category->id,
                'expires_at' => now()->addDays(20)->format('Y-m-d'),
                'show_phone_number' => 'on',
            ]
        );

        // Assert
        $this->assertDatabaseHas('posts', ['title' => 'testTitle']);

        $response->assertRedirect(route('dashboard'));
        // AAA
    }
}
