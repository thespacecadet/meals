<?php

namespace App\Http\Controllers;

use App\Models\Additive;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdditiveController extends Controller
{
    public function index(): JsonResponse
    {
        $meals = Additive::all();
        return response()->json(['message' => 'OK', 'status' => 200, 'content' => $meals])->setStatusCode(200);
    }
    public function show($additive_id): JsonResponse
    {
        $additive = Additive::findOrFail($additive_id);
        return response()->json(['message' => 'OK', 'status' => 200, 'content' => $additive])->setStatusCode(200);
    }
}
