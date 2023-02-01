<?php

namespace App\Http\Controllers;

use App\Models\Section;
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
        $section->save();
        return response()->json($section, 201);
    }

    public function deleteSection(int $id): JsonResponse
    {
        Section::destroy($id);
        return response()->json(['message' => 'Section was deleted'], 202);
    }

}
