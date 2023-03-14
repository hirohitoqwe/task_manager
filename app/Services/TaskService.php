<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskService
{
    public function createTask(array $data): JsonResponse
    {
        try {
            $task = new Task();
            $task->task_name = $data['task_name'];
            $task->user_id = $data['user_id'] ?? null;
            $task->section_id = $data['section_id'] ?? null;
            $task->task_status = true;
            $task->save();
            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Create Task Exception'], 400);
        }
    }

    public function changeTaskStatus(Task $task)
    {
        $task->task_status = !$task->task_status;
        $task->save();
        return response()->json($task, 200);
    }

}
