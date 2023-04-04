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

    public function test_crud_task()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        //Create task Test :)
        $createdTask = $this->post('/api/task', ['task_name' => 'test_task', 'user_id' => $user->id]);
        $createdTask->assertStatus(201);
        //Update task status Test :)
        $updateTask = $this->patch("/api/task/{$createdTask->original->id}");
        $updateTask->assertStatus(200);
        $original_status = $createdTask->original->task_status;
        $this->assertTrue($original_status);
        $changedStatus = $updateTask->original->task_status;
        $this->assertFalse($changedStatus);
        //Delete task Test :)
        $deleteTask = $this->delete("/api/task/{$createdTask->original->id}");
        $deleteTask->assertStatus(202);
    }

}
