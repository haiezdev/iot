<?php

namespace App\Http\Controllers;
use phpseclib3\Net\SSH2;
use Illuminate\Http\Request;
use App\Models\CommandList;
use App\Models\Device;


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
    

public function sendSSH(Request $request) {
    $ip = $request->input('ip');

    if (!$ip) {
        return back()->with('error', 'Không tìm thấy IP thiết bị.');
    }

    return view('users.operator.send-ssh', compact('ip'));
}




public function executeSSH(Request $request) {
    $request->validate([
        'ip' => 'required|ip',
        'command' => 'required|string',
    ]);

    $ip = $request->input('ip');

    try {
        $ssh = new \phpseclib3\Net\SSH2($ip);
        if (!$ssh->login('ubuntu', '123456789')) {
            return response()->json(['success' => false, 'error' => 'Đăng nhập SSH thất bại!']);
        }

        $output = nl2br($ssh->exec($request->command));
        return response()->json(['success' => true, 'output' => $output]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}




}
