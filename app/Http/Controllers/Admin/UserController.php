<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    // Cấp lại mật khẩu
    public function resetPassword(Request $request, User $user)
    {
        $request->validate(['password' => 'required|min:8']);
        
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', "Đã đổi mật khẩu cho user {$user->name}");
    }

   public function toggleBlock(User $user)
    {
        
        $user->update(['is_blocked' => !$user->is_blocked]);

        $status = $user->is_blocked ? 'khóa' : 'mở khóa';
        
        return back()->with('success', "Đã thay đổi trạng thái tài khoản {$user->name} thành {$status}.");
    }
}