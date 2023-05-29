<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_crud_task()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        //Create task Test :)
        $task = Task::factory()->create();
        $createdTask = $this->post('/api/task', ['task_name' => $task->task_name, 'user_id' => $task->user_id, 'section_id' => $task->section_id, 'task_status' => $task->task_status]);
        $createdTask->assertStatus(201);
        //Update task status Test :)
        $updateTask = $this->patch("/api/task/{$task->id}");
        $updateTask->assertStatus(200);
        $original_status = $task->task_status;
        $this->assertTrue($original_status);
        $changedStatus = $updateTask->original->task_status;
        $this->assertFalse($changedStatus);
        //Delete task Test :)
        $deleteTask = $this->delete("/api/task/{$task->id}");
        $deleteTask->assertStatus(202);
    }
}
