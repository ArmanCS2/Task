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
    public function login(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);
        if ($data->fails()) {
            return response()->json([
                'errors' => $data->errors()
            ]);
        }
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = Auth::user();
            return response()->json([
                'message' => 'User logged in successfully',
                'data' => $user,
                'token' => $user->createToken('token')->plainTextToken
            ]);
        }
        return response()->json([
            'errors' => 'user not found'
        ]);


    }

    public function register(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'is_admin'=>'nullable|in:0,1',
        ]);
        if ($data->fails()) {
            return response()->json([
                'errors' => $data->errors()
            ]);
        }
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin'=>$request->is_admin ?? 0
        ]);
        return response()->json([
            'message' => 'User registered successfully',
            'data' => $user,
            'token' => $user->createToken('token')->plainTextToken
        ]);
    }
}
