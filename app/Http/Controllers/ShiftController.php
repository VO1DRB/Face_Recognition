<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        return response()->json(Shift::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'start_time'           => 'required|date_format:H:i:s',
            'end_time'             => 'required|date_format:H:i:s',
            'grace_period_minutes' => 'nullable|integer|min:0',
        ]);

        $shift = Shift::create($validated);

        return response()->json($shift, 201);
    }

    public function show(Shift $shift)
    {
        return response()->json($shift);
    }

    public function update(Request $request, Shift $shift)
    {
        $validated = $request->validate([
            'name'                 => 'sometimes|required|string|max:255',
            'start_time'           => 'sometimes|required|date_format:H:i:s',
            'end_time'             => 'sometimes|required|date_format:H:i:s',
            'grace_period_minutes' => 'nullable|integer|min:0',
        ]);

        $shift->update($validated);

        return response()->json($shift);
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();
        return response()->json(['message' => 'Shift deleted successfully']);
    }
}
