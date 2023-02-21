<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function getSection():JsonResponse
    {
        return response()->json(Section::all(),200);
    }

    public function createSection(Request $request): JsonResponse
    {
        $section = new Section();
        $section->section_name = $request->section_name;
        $section->user_id = $request->user_id ?? null;
        $section->save();
        return response()->json($section, 201);
    }

    public function deleteSection(int $id): JsonResponse
    {
        Task::where('section_id','=',$id)->delete();
        Section::destroy($id);
        return response()->json(['message' => 'Section and tasks of this section was deleted'], 202);
    }

}
