<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandList;

class CommandListController extends Controller
{
    // Danh sách lệnh (index)
    public function index() {
        $commandlists = CommandList::all();
        // Biến $commandlists sẽ dùng trong command-index.blade.php
        return view('users.teamlead.command_list.command-index', compact('commandlists'));
    }

    // Form tạo mới
    public function create() {
        return view('users.teamlead.command_list.command-create');
    }

    // Lưu lệnh mới
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'commands' => 'required', // Có thể lưu JSON hoặc TEXT tuỳ bạn
        ]);
        CommandList::create($request->only('name', 'commands', 'description'));
        return redirect()->route('command-lists.index')->with('message', 'Tạo danh sách lệnh thành công!');
    }

    // Form sửa lệnh
   // Trong Controller
public function edit($id) {
    $commandList = CommandList::findOrFail($id);
    return view('users.teamlead.command_list.command-edit', compact('commandList'));
}

public function update(Request $request, $id) {
    $commandList = CommandList::findOrFail($id);
    $request->validate([
        'name' => 'required',
        'commands' => 'required',
    ]);
    $commandList->update($request->only('name', 'commands', 'description'));
    return redirect()->route('command-lists.index')->with('message', 'Cập nhật thành công!');
}


    // Xoá lệnh
    public function destroy($id) {
        $command = CommandList::findOrFail($id);
        $command->delete();
        return redirect()->route('command-lists.index')->with('message', 'Xoá thành công!');
    }
}
