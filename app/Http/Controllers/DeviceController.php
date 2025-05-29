<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceGroup;

class DeviceController extends Controller
{
    public function index() {
        $devices = Device::with('deviceGroup')->get();
        foreach ($devices as $device) {
            $device->status = $this->isDeviceOnline($device->ip_address);
        }
        return view('users.teamlead.device.device-index', compact('devices'));
    }
    
    // Hàm kiểm tra online/offline
    private function isDeviceOnline($ip)
    {
        $ping = "ping -n 1 -w 1 $ip";
        exec($ping, $output, $result);
        return $result === 0 ? 1 : 0; // 1: online, 0: offline
    }

    public function create() {
        $groups = DeviceGroup::all();
        return view('users.teamlead.device.device-create', compact('groups'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'device_group_id' => 'nullable|exists:device_groups,id',
        ]);
        // Kiểm tra ping IP trước khi tạo device
        if (!$this->pingDevice($request->ip_address)) {
            return back()->withInput()->withErrors(['ip_address' => 'Không tìm thấy thiết bị tại IP này (ping không thành công)!']);
        }

        Device::create([
            'name' => $request->name,
            'ip_address' => $request->ip_address,
            'status' => 1, // Active
            'device_group_id' => $request->device_group_id,
            'description' => $request->description,
        ]);
        return redirect()->route('devices.index')->with('message', 'Tạo thiết bị thành công!');
    }

    public function edit($id) {
        $device = Device::findOrFail($id);
        $groups = DeviceGroup::all();
        return view('users.teamlead.device.device-edit', compact('device', 'groups'));
    }

    public function update(Request $request, $id) {
        $device = Device::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'device_group_id' => 'nullable|exists:device_groups,id',
        ]);
        // Ping lại IP
        $active = $this->pingDevice($request->ip_address) ? 1 : 0;

        $device->update([
            'name' => $request->name,
            'ip_address' => $request->ip_address,
            'status' => $active,
            'device_group_id' => $request->device_group_id,
            'description' => $request->description,
        ]);
        if (!$active) {
            return back()->withInput()->withErrors(['ip_address' => 'Cảnh báo: IP này hiện không online (status sẽ là Inactive)!']);
        }
        return redirect()->route('devices.index')->with('message', 'Cập nhật thiết bị thành công!');
    }

    public function destroy($id) {
        $device = Device::findOrFail($id);
        $device->delete();
        return redirect()->route('devices.index')->with('message', 'Xoá thiết bị thành công!');
    }

    // HÀM PING
    private function pingDevice($ip) {

        $command = "ping -n 1 -w 2000 $ip";

        exec($command, $output, $result);
        return $result === 0;
    }
    

public function assignedToOperator() {
    $devices = Device::with('deviceGroup')->get();
    foreach ($devices as $device) {
        $device->status = $this->isDeviceOnline($device->ip_address);
    }
    return view('users.operator.assigned-devices', compact('devices'));
}



}
