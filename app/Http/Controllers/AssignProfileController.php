<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignProfile;
use App\Models\Profile;
use App\Models\User;

class AssignProfileController extends Controller
{
    public function index() {
        $assigns = AssignProfile::with('profile', 'user')->get();
        return view('users.teamlead.assign_profile.index', compact('assigns'));
    }

    public function create() {
        $profiles = Profile::all();
        $operators = User::where('role', 'operator')->get();
        return view('users.teamlead.assign_profile.create', compact('profiles', 'operators'));
    }

    public function store(Request $request) {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'user_id' => 'required|exists:users,id',
        ]);
        AssignProfile::create($request->only('profile_id', 'user_id'));
        return redirect()->route('assign-profile.index')->with('message', 'Gán hồ sơ thành công!');
    }

    public function destroy($id) {
        $assignment = AssignProfile::findOrFail($id);
        $assignment->delete();
        return redirect()->route('assign-profile.index')->with('message', 'Xoá thành công!');
    }
}
