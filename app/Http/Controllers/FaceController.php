<?php

namespace App\Http\Controllers;

use App\Models\Face;
use Illuminate\Http\Request;

class FaceController extends Controller
{
    public function index()
    {
        $faces = Face::with(['user', 'device'])->get();
        return response()->json($faces);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'device_id'     => 'nullable|exists:devices,id',
            'encoding_path' => 'required|string|max:255',
            'image_path'    => 'nullable|string|max:255',
            'created_by'    => 'nullable|exists:users,id',
        ]);

        $face = Face::create($validated);

        return response()->json($face, 201);
    }

    public function show(Face $face)
    {
        return response()->json($face->load(['user', 'device']));
    }

    public function update(Request $request, Face $face)
    {
        $validated = $request->validate([
            'device_id'     => 'nullable|exists:devices,id',
            'encoding_path' => 'sometimes|required|string|max:255',
            'image_path'    => 'nullable|string|max:255',
        ]);

        $face->update($validated);

        return response()->json($face);
    }

    public function destroy(Face $face)
    {
        $face->delete();
        return response()->json(['message' => 'Face deleted successfully']);
    }
}
