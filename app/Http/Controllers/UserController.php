<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class UserController extends Controller
{
    public function getCurrentUser(): JsonResponse
    {
        return response()->json(auth()->user(), 200);
    }

    public function getCurrentUserID(): JsonResponse
    {
        return response()->json(auth()->user()->id,200);
    }

}
