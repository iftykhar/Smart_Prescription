<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $attributes = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        );
        User::create($attributes);
        return response()->json(['message' => 'create success'], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()], 400);
        }
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->input('email'))->first();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout success'], 200);
    }
}
