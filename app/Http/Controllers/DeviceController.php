<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_device' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'ip_address' => 'nullable|ip'
        ]);

        $device = Device::create($validated);
        return redirect()->route('devices.index')
            ->with('success', 'Device berhasil ditambahkan');
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'nama_device' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'ip_address' => 'nullable|ip'
        ]);

        $device->update($validated);
        return redirect()->route('devices.index')
            ->with('success', 'Device berhasil diperbarui');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')
            ->with('success', 'Device berhasil dihapus');
    }
}