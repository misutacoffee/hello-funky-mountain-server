<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Mail\EmailVerification;
use App\Mail\PasswordResetNotification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;

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
            $token = $user->createToken('token')->plainTextToken;
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
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['success' => true, 'message' => 'Successfully logged out.']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required | email', 
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            $token = bin2hex(random_bytes(32));
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email], 
                ['email' => $user->email, 'token' => Hash::make($token), 'created_at' => now()]
            );
            $url = config('app.url').'/password-reset?token='.$token.'&email='.urlencode($user->email);

            Mail::to($user->email)->send(new PasswordResetNotification($user, $url));
        }
        return response()->json(['user' => $user, 'success' => true, 'message' => "Please check your inbox for a password reset notification."]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => [
                'required', 
                'string', 
            ], 
            'email' => [
                'required', 
                'string', 
                'email', 
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
        ]);
        $resetToken = DB::table('password_reset_tokens')->where(['email' => $request->email],['token' => Hash::make($request->token)])->orderBy('created_at', 'desc')->first();
        if($resetToken){
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            $token = $user->createToken('token')->accessToken;
            $resetToken->delete();
            return response()->json(['user' => $user, 'token' => $token, 'success' => true, 'message' => "Password successfully updated to the database."]);
        }else{
            return response()->json(['success' => false, 'message' => "Password failed to be update."]);
        }
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
        $token = $user->createToken('token')->plainTextToken;
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification()),
            ], 
            absolute: false, 
        );
        $url = config('app.url').str_replace('/api', '', $url);
        Mail::to($user->email)->send(new EmailVerification($user, $url));
        return response()->json(['user' => $user, 'token' => $token, 'success' => true, 'message' => "User successfully registered."]);
    }

    public function verifyEmail(Request $request)
    {
        // 
    }

}
