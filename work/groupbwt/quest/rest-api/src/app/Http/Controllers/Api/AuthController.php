<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            ['password' => bcrypt($request->password)]
        ));
        $user->assignRole('user');
        return response()->api([], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return response()->api([], Response::HTTP_BAD_REQUEST);
        }
        $token = Str::random(60);
        auth()->user()->saveToken($token);
        return response()->api([
            'token_type' => 'Bearer',
            'token' => $token
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();
        return response()->api();
    }
}
