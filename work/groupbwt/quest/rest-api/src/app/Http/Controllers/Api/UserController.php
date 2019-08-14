<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get();
        return response()->api($users);
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create($request->all());
        return response()->api($user, Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        return response()->api($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->api($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->api();
    }

    public function restore($id)
    {
        User::onlyTrashed()->find($id)->restore();
        return response()->api();
    }
}
