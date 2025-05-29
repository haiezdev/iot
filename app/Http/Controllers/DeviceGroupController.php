<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceGroup;

class DeviceGroupController extends Controller
{
    public function index() {
        $groups = DeviceGroup::all();
        return view('users.teamlead.device_group.index', compact('groups'));
    }
    
    public function create() {
        return view('users.teamlead.device_group.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required']);
        DeviceGroup::create($request->only('name', 'description'));
        return redirect()->route('device-groups.index')->with('message', 'Tạo nhóm thiết bị thành công!');
    }

    public function edit($id) {
        $group = DeviceGroup::findOrFail($id);
        return view('users.teamlead.device_group.edit', compact('group'));
    }

    public function update(Request $request, $id) {
        $group = DeviceGroup::findOrFail($id);
        $group->update($request->only('name', 'description'));
        return redirect()->route('device-groups.index')->with('message', 'Cập nhật thành công!');
    }

    public function destroy($id) {
        $group = DeviceGroup::findOrFail($id);
        $group->delete();
        return redirect()->route('device-groups.index')->with('message', 'Xoá thành công!');
    }
}
