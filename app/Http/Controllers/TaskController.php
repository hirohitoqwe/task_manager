<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Section;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function __construct(private readonly TaskService $service)
    {
    }

    public function addTask(TaskRequest $request): JsonResponse
    {
        return $this->service->createTask($request->validated());
    }

    public function getSectionTask(int $sectionID): JsonResponse
    {
        $section = Section::find($sectionID);
        return response()->json($section->tasks()->get(), 200);
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
        return $this->service->changeTaskStatus(Task::find($taskID));

    }

    public function deleteTask(int $taskId): JsonResponse
    {
        Task::destroy($taskId);
        return response()->json(['status' => 'ok'], 202);
    }


}
