<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\CommandList;
use App\Models\DeviceGroup;

class ProfileController extends Controller
{
    public function index() {
        $profiles = Profile::with('commandList', 'deviceGroup')->get();
        return view('users.teamlead.profile.profile-index', compact('profiles'));
    }

    public function create() {
        $commandLists = CommandList::all();
        $deviceGroups = DeviceGroup::all();
        return view('users.teamlead.profile.profile-create', compact('commandLists', 'deviceGroups'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'command_list_id' => 'required|exists:command_lists,id',
            'device_group_id' => 'required|exists:device_groups,id',
        ]);
        Profile::create($request->only('name', 'description', 'command_list_id', 'device_group_id'));
        return redirect()->route('profiles.index')->with('message', 'Tạo hồ sơ thành công!');
    }

    public function edit($id) {
        $profile = Profile::findOrFail($id);
        $commandLists = CommandList::all();
        $deviceGroups = DeviceGroup::all();
        return view('users.teamlead.profile.profile-edit', compact('profile', 'commandLists', 'deviceGroups'));
    }

    public function update(Request $request, $id) {
        $profile = Profile::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'command_list_id' => 'required|exists:command_lists,id',
            'device_group_id' => 'required|exists:device_groups,id',
        ]);
        $profile->update($request->only('name', 'description', 'command_list_id', 'device_group_id'));
        return redirect()->route('profiles.index')->with('message', 'Cập nhật hồ sơ thành công!');
    }

    public function destroy($id) {
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return redirect()->route('profiles.index')->with('message', 'Xoá hồ sơ thành công!');
    }
}
