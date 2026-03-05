<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        return response()->json(Meal::with('ingreditents')->get(),200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingreditents' => 'required|array',
            'ingreditents.*' => 'exists:ingreditents,id',
        ]);

        $meal = Meal::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]); 

        $meal->ingreditents()->attach($validated['ingreditents']);

        return response()->json($meal->load('ingreditents'), 201);
    }
    public function update(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'ingreditents' => 'sometimes|required|array',
            'ingreditents.*' => 'exists:ingreditents,id',
        ]);

        $meal->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]); 

        $meal->ingreditents()->sync($validated['ingreditents']);

        return response()->json($meal->load('ingreditents'), 200);

    }

    public function search($ingedient)
    {
        $meal = Meal::whereHas('ingreditents', function ($query) use ($ingedient) {
            $query->where('name', 'like', '%' . $ingedient . '%');
        })->with('ingreditents')->get();

        return response()->json($meal, 200);
    }
}
