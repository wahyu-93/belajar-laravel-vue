<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name'  => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return new UserResource($user);
    }

    public function delete($id)
    {
        User::destroy($id);
        return 'success';
    }

    public function update(Request $request, $id)
    {   
        $user = User::find($id);
        $user->update([
            'name'  => request('name'),
            'email' => request('email'),
            'password'  => bcrypt(Request('password'))
        ]);

        return new UserResource($user);
    }
}
