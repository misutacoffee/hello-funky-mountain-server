<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        
    }
    
    public function logout(Request $request)
    {
        
    }
    
    public function forgotPassword(Request $request)
    {
        
    }

    public function passwordReset(Request $request)
    {
        
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => [
                'required', 
                'string', 
            ], 
            'email' => [
                'required', 
                'string', 
                'email', 
                'unique:App\Models\User,email', 
            ], 
            'password' => [
                'required', 
                'string', 
                'confirmed:confirm_password', 
                Password::min(8)->max(256)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 
                ], 
            'confirm_password' => [
                'required', 
                'string', 
            ], 
            'uuid' => [
                'required', 
                'string', 
                'uuid:4', 
                'unique:App\Models\User,uuid', 
            ], 
        ]);
        $user = User::create($request->all());
        $token = $user->createToken('token')->accessToken;
        return response()->json(['user' => $user, 'token' => $token, 'success' => true, 'message' => "User successfully registered."]);
    }

    public function verifyEmail(Request $request)
    {
        
    }

}
