<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Support\Facades\Hash;

class AuthService 
{

    public function handleUserLogin($request)
    {
        $fields = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required'
        ]);
        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;
        $user->roles;

        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function handleUserRegistration($request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
            'role' => 'required',
            'allowed_locations' => 'required'
        ]);

        $user = User::create($fields);
        $user->assignRole($fields['role']);


        $meta = UserMeta::create([
            'user_id' => $user->id,
            'allowed_locations' => $fields['allowed_locations']
        ]);

        if ($user && $meta) {
            return response('User registered successfully', 201);
        }

        return response('Error creating user, please try again', 500);
    }

}