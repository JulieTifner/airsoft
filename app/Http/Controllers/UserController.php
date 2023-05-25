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


    public function edit(){

        $users = User::all();
        $roles = Role::all();

        return view('admin.edit-user')->with([
            'users' => $users,
            'roles' => $roles,

        ]);
    }
}
