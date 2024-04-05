<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->roles != 'ADMIN') {
            return redirect()->route('home');
        }
        $users = User::when($request->input("name"), function ($query, $name) {
            return $query->where("name", "like", "%" . $name . "%");
        })
            ->orderBy("id")
            ->paginate(10);

        return view("pages.users.index", compact("users"));
    }
    public function create()
    {
        if (Auth::user()->roles != 'ADMIN') {
            return redirect()->route('home');
        }
        return view("pages.users.create");
    }

    public function store(StoreUserRequest $request)
    {
        if (Auth::user()->roles != 'ADMIN') {
            return redirect()->route('home');
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User Successfully Created');
    }

    public function edit($id)
    {
        if (Auth::user()->roles != 'ADMIN') {
            return redirect()->route('home');
        }
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (Auth::user()->roles != 'ADMIN') {
            return redirect()->route('home');
        }
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User Successfully Updated');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->roles != 'ADMIN') {
            return redirect()->route('home');
        }
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Successfully Deleted');
    }
}
