<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function getTasks()
    {
        //TODO TaskRepository
    }

    public function addTask(TaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = new Task();
        $task->task_name = $validated['task_name'];
        $task->user_id = $validated['user_id'] ?? null;
        $task->section_id = $validated['section_id'] ?? null;
        $task->save();
        return response()->json($task, 200);
        //TODO TRY CATCH IN SERVICE
    }

}
