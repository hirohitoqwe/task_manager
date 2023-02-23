<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Section;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function addTask(TaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = new Task();
        $task->task_name = $validated['task_name'];
        $task->user_id = $validated['user_id'] ?? null;
        $task->section_id = $validated['section_id'] ?? null;
        $task->task_status = true;
        $task->save();
        return response()->json($task, 200);
        //TODO TRY CATCH IN SERVICE

    }

    public function getSectionTask(int $sectionID): JsonResponse
    {
        $section = Section::find($sectionID);
        return response()->json($section->tasks()->get(), 200);//TODO TRY CATCH
    }

    public function getTasksByUser(int $userID): JsonResponse
    {
        $tasks = Task::where('user_id', $userID)->get();
        return response()->json($tasks, 200);
    }

    public function getTasks(int $userId): JsonResponse
    {
        return response()->json(Task::where('section_id', null)->where('user_id', $userId)->get(), 200);
    }

    public function changeTaskStatus(int $taskID): JsonResponse
    {
        $task = Task::find($taskID);
        $task->task_status = !$task->task_status;
        $task->save();
        return response()->json($task, 200);
    }

    public function deleteTask(int $taskId): JsonResponse
    {
        Task::destroy($taskId);
        return response()->json(['status' => 'ok'], 202);
    }


}
