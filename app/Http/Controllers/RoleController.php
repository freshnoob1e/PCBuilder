<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::latest()->get();
        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function destroy(User $user, Request $req){
        $user->roles()->detach($req->role_id);
        return redirect()->route('admin-users-edit', $user->id);
    }
}
