<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
     

    public function test_index(): void
    {

        User::factory(20)->create();

        $response = $this->getJson('/api/users?page=1');

        $response->assertStatus(Self::Success)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'email', 'password', 'status'],
                ],
                'links',
                'meta',
            ]);

    }

    public function test_create(): void
    {
        $user = [
            'name' => 'mahmoud abdelrahman',
            'email' => 'mahmoud@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 1,
        ];

        $response = $this->postJson('/api/users', $user);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', $user);
        $response->assertJson(['data' => $user]);

    }

    public function test_update(): void
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'abdelrahman',
            'email' => 'abdelrahman@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => 2,
        ];
        $response = $this->putJson('/api/users/' . $user->id, $data);
        $response->assertStatus(Self::Success);
        $this->assertDatabaseHas('users', $data);
        $response->assertJson(['data' => $data]);

    }

    public function test_delete(): void
    {
        $user = User::factory()->create();
        $response = $this->deleteJson('/api/users/' . $user->id);
        $response->assertStatus(Self::Success);
        $this->assertDatabaseMissing('users', $user->toArray());
    }

}
