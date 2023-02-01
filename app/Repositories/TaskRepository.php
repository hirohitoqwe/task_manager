<?php

namespace App\Repositories;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Task;

/**
 * Class TaskRepository.
 */
class TaskRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model(): string
    {
        return Task::class;
    }

    public function getUserTask(User $user):JsonResponse
    {
        return response()->json(Task::where('user_id',$user->id)->get(),200);
    }

}
