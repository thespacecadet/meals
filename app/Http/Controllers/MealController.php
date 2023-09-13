<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MealController extends Controller
{

    public function index(): JsonResponse
    {
        $meals = Meal::all();
        return response()->json(['message' => 'OK', 'status' => 200, 'content' => $meals])->setStatusCode(200);
    }

    public function show($meal_id): JsonResponse
    {
        $meal = Meal::findOrFail($meal_id);
        return response()->json(['message' => 'OK', 'status' => 200, 'content' => $meal])->setStatusCode(200);
    }
}
