<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::latest()->paginate(10);
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_device' => 'required|string|max:255',
            'lokasi'      => 'required|string|max:255',
            'ip_address'  => 'nullable|ip',
            'meta'        => 'nullable|array',
        ]);

        $validated['device_code'] = 'DEV-' . strtoupper(Str::random(6));
        $validated['status']      = 'nonaktif'; // default
        $validated['last_seen']   = now();

        Device::create($validated);

        return redirect()->route('devices.index')
            ->with('success', 'Device berhasil ditambahkan');
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'nama_device' => 'required|string|max:255',
            'lokasi'      => 'required|string|max:255',
            'ip_address'  => 'nullable|ip',
            'status'      => 'required|in:aktif,nonaktif',
            'meta'        => 'nullable|array',
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

    /**
     * Tandai device sedang online (heartbeat dari IoT)
     */
    public function heartbeat(Device $device, Request $request)
    {
        $device->update([
            'status'    => 'aktif',
            'last_seen' => now(),
            'ip_address'=> $request->ip(),
        ]);

        return response()->json([
            'message' => 'Device heartbeat diterima',
            'device'  => $device,
        ], 200);
    }
}
