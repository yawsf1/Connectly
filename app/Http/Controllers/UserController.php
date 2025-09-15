<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $inputs = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'email', 'max:60', Rule::unique('users', 'email')],
            'password' => ['required', Password::min(8)],
        ]);

        $inputs['name'] = strip_tags($inputs['name']);
        $inputs['password'] = bcrypt($inputs['password']);

        $user = User::create($inputs);
        Auth::login($user);

        return redirect()->route('home');
    }

    // Login an existing user
    public function login(Request $request)
    {
        $inputs = $request->validate([
            'email' => ['required', 'email', 'max:60'],
            'password' => ['required', Password::min(8)],
        ]);

        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Invalid credentials.'
        ], 'login');
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();  
        $request->session()->regenerateToken(); 
        return redirect('/');
    }

    // Redirect to Google for OAuth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(str()->random(16)), 
                ]
            );

            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            Auth::login($user);

            return redirect()->route('home');

        } 
        catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'Google login failed. Please try again.'
            ]);
        }
    }
}
