<?php


namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_category_api(): void
    {
        // Arrange
        $user = User::factory()->create();
        $this->be($user);

        $category = Category::factory()->create();


        // Act
        $response =  $this->deleteJson('/api/category/'. $category->id);

        // Assert
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);

        $response->assertStatus(204);
        // AAA
    }
}
