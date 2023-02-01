<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{

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
