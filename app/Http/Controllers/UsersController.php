<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\{User};
use DB;

class UsersController extends Controller
{
    public function index()
    {
        $you = auth()->user();
        $users = User::with('roles')->where('id', '!=', 1)->get();
        $roles = DB::table('roles')->where('id',1)->orWhere('id',2)->orWhere('id',3)->get();
        return view('dashboard.admin.usersList', compact('users', 'you', 'roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = new User;
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'User added successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.userShow', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            array_push($user_roles, $role->id);
        }

        return view('dashboard.admin.userEditForm', compact('user', 'user_roles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256',
        ]);

        $user = User::find($id);
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');

        if ($request->password) {
            $validatedData = $request->validate([
                'name'       => 'required|min:1|max:256',
                'email'      => 'required|email|max:256',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        $current_roles =  $user->getRoleNames()->toArray();
        $new_roles = [];
        foreach ($request->roles as $role) {
            $status = in_array($role, $current_roles);
            if (!$status) {
                $user->assignRole($role);
            }
            array_push($new_roles, $role);
        }

        foreach ($current_roles as $role) {
            $status = in_array($role, $new_roles);
            if (!$status) {
                $user->removeRole($role);
            }
        }
        return redirect()->route('users.index')->with('success', 'Successfully Updated User!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $deleted_count = User::withTrashed()->where('email', 'LIKE', '%' . $user->email . '%')->count() + 1;
            $user->email = $user->email . '-deleted' . $deleted_count;
            $user->save();
            $user->delete();
        }
        return redirect()->route('users.index')->with('success', 'Successfully Deleted User!');
    }
}
