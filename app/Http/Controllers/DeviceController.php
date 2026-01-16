<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function adminDashboard()
    {
        // Saari devices ko unke users ke sath fetch karein
        $devices = \App\Models\Device::with('user')->orderBy('created_at', 'desc')->get();
        
        return view('admin.dashboard', compact('devices'));
    }
    
    public function toggleApproval($id)
    {
        $device = \App\Models\Device::findOrFail($id);
        
        // Status flip karein (0 ko 1, aur 1 ko 0)
        $device->is_approved = !$device->is_approved;
        $device->save();
    
        return back()->with('success', 'Device status updated!');
    }
}
