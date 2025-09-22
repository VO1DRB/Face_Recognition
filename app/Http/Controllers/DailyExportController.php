<?php

namespace App\Http\Controllers;

use App\Models\DailyExport;
use Illuminate\Http\Request;

class DailyExportController extends Controller
{
    public function index()
    {
        return response()->json(DailyExport::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required|date|unique:daily_exports,date',
            'file_path'=> 'required|string|max:255',
            'status'   => 'nullable|in:pending,sent,failed',
        ]);

        $export = DailyExport::create($validated);

        return response()->json($export, 201);
    }

    public function show(DailyExport $dailyExport)
    {
        return response()->json($dailyExport);
    }

    public function update(Request $request, DailyExport $dailyExport)
    {
        $validated = $request->validate([
            'file_path'=> 'sometimes|required|string|max:255',
            'sent_to_whatsapp_at' => 'nullable|date',
            'status'   => 'nullable|in:pending,sent,failed',
        ]);

        $dailyExport->update($validated);

        return response()->json($dailyExport);
    }

    public function destroy(DailyExport $dailyExport)
    {
        $dailyExport->delete();
        return response()->json(['message' => 'Daily export deleted successfully']);
    }
}
