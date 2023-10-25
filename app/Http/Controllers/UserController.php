<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $email=$request->email;
        $password=$request->password;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'res' => false,
                'message' => 'Credenciales incorrectas'
            ], 200);
        }else{
            if (Hash::check($password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'res' => true,
                    'message' => 'Bienvenido',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }else{
                return response()->json([
                    'res' => false,
                    'message' => 'Credenciales incorrectas'
                ], 200);
            }
        }
    }
    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'res' => true,
            'message' => 'Adios'
        ], 200);
    }
}
