<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.users')->with([
            'users' => $users,
            'roles' => $roles,

        ]);
    }


    public function edit(User $user)
    {
        $users = User::all();
        $roles = Role::all();
        $user = User::find($user);

        return view('admin.edit-user')->with([
            'users' => $users,
            'roles' => $roles,

        ]);
    }
    

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $user->role_id = $validatedData['role'];
        $user->save();

        return redirect()->back()->with('success', 'Rolle erfolgreich aktualisiert.');
    }

}
