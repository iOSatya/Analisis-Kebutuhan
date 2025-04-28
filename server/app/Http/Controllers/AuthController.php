<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            $data = $request->validate([
                "username" => ["required"],
                "email" => ["required", "email"],
                "password" => ["required"]
            ]);

            User::create($data);

            return response()->json(["message" => "Register Success"], 201);

        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 400);
        }
    }

    public function login(Request $request) {
        try {
            $request->validate([
                "email" => ["required", "email"],
                "password" => ["required"]
            ]);

            $user = User::where("email", $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(["message" => "Invalid Credentials"], 401);
            }

            $token = $user->createToken($user->name)->plainTextToken;

            return response()->json(["message" => "Login Success", "token" => $token], 200);

        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 500);
        }
    }

    public function logout(Request $request) {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(["message" => "Logout Success"], 200);
        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 500);
        }
        
    }
}
