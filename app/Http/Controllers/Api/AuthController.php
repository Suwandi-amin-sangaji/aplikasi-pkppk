<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'akses' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'akses' => $request->akses,
            'phone' => $request->phone
        ]);

        $token = $user->createToken('auth_app_pkppk')->plainTextToken;

        return response()->json([
            'error' => false,
            'message' => 'Berhasil mendaftar',
            'data' => [
            'user' => $user,
            'token' => $token,
            'type' => 'Bearer'
            ]
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_app_pkppk')->plainTextToken;
        return $this->sendResponse([
            'user' => $user->name,
            'token' => $token,
            'type' => 'Bearer'
        ], 'login success');
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }

}
