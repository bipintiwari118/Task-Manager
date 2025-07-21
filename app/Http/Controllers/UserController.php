<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UserController extends Controller
{
    public function list()
    {
        $users = User::paginate(10);
        return view('admin.user.list', compact('users'));
    }

     public function create()
    {
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request){
         $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $validatedData['password'],
    ]);

    //roles store in model has roles table please check there
    $user->syncRoles($request->roles);

     return redirect()->route('users.list')->with('success', 'User created successfully.');

    }

      public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user','roles'));
    }

     public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $data['password'] = Hash::make($data['password']);

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('users.list')->with('success', 'User updated successfully.');
    }

     public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.list')->with('success', 'User deleted successfully.');
    }


}
