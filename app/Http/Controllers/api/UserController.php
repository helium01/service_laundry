<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255',
            'role'=>'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create([
            'name'=>$request->name,
            'password'=>$validatedData['password'],
            'email'=>$request->email,
            'role'=>$request->role,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'data'=>$user,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($validatedData)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'data'=>auth()->user(),
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    public function home()
    {
        if (auth()->check()) {
            $data = Auth::user();

            return response()->json([
                'status' => 'login',
                'data' => $data
            ]);// User telah login
        } else {
            return response()->json([
                'status' => 'belum login',
                'data'=>'anda belum melakukan login'
            ]);// User belum login
        }

       
    }
}
