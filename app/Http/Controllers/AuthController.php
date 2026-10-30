<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Mail\PasswordResetNotification;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required', 
                'string', 
                'email', 
            ], 
            'password' => [
                'required', 
                'string', 
            ], 
        ]);
        $credentials = $request->all();
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;
            return response()->json([
                'success' => true, 
                'message' => "Login successful.", 
                'user' => $user, 
                'token' => $token, 
            ]);
        }else{
            $user = Auth::user();
            return response()->json([
                'success' => false, 
                'message' => "Login failed.", 
            ]);
        }
    }
    
    public function logout(Request $request)
    {
        
    }
    
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required | email', 
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            Mail::to($user->email)->send(new PasswordResetNotification($user));
        }
        return response()->json(['user' => $user, 'success' => true, 'message' => "Please check your inbox for a password reset notification."]);
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
