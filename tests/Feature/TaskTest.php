<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_task()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $createdTask = $this->post('/api/task', ['task_name' => 'test_task', 'user_id' => $user->id]);
        $createdTask->assertStatus(201);
        //Delete task Test :)
        $response = $this->delete("/api/task/{$createdTask->original->id}");
        $response->assertStatus(202);
    }

}
