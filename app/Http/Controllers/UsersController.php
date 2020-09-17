<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function index()
    {
        return view('users.index', [
            'users' => \App\User::paginate(12)
        ]);
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $req)
    {
        $this->validate($req, \App\User::$rules);
        $user = new \App\User();
        $user->fill($req->all());
        $user->password = bcrypt($req->password);
        $user->email_verified_at = now();
        $user->save();

        return redirect('/users');
    }


    public function show($id)
    {
        //
    }


    public function edit(\App\User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function edit_pass(\App\User $user)
    {
        return view('users.edit_pass', [
            'user' => $user,
        ]);
    }

    public function update_pass(Request $req, \App\User $user)
    {
        $this->validate($req, \App\User::$update_pass_rules);
        $user->password = bcrypt($req->password);
        $user->save();

        return redirect('/users');
    }

    public function update(Request $req, \App\User $user)
    {
        $this->validate($req, \App\User::$update_rules);
        $req->validate([
            'email' => [Rule::unique('users', 'email')->whereNot('email', $user->email)]
        ]);

        $user->fill($req->all());
        $user->save();

        return redirect('/users');
    }

    public function destroy(\App\User $user)
    {
        // 最後のユーザーは消せないようにする
        if (\App\User::count() > 1) {
            $user->delete();
        }

        return redirect()->back();
    }
}
