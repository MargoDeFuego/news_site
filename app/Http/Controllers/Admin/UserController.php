<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // список пользователей
    public function index()
    {
        $users = User::with('role')->paginate(15);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    // обновление роли пользователя
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Роль пользователя обновлена!');
    }
}
