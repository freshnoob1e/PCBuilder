<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->with('roles')->get();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function edit(User $user){
        $roles = Role::latest()->get();
        return view('admin.users.edit', [
            'user' => $user->load('roles'),
            'roles' => $roles
        ]);
    }

    public function update(User $user, Request $req){
        $req->validate(['role' => ['required', 'exists:roles,id']]);
        $role_id = $req->role;
        $user->roles()->toggle($role_id);
        return redirect()->route('admin-users-edit', $user->id);
    }
}
