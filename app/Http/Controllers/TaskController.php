<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Section;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
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
        $repository = new TaskRepository();//TODO user service container
        $user = User::find($userID);
        return $repository->getUserTask($user);

    }

    public function getTasks(): JsonResponse
    {
        return response()->json(Task::where('section_id', null)->get(), 200);
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
        return response()->json(['status'=>'ok'],202);
    }


}
