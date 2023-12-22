<?php

namespace App\Http\Controllers;

use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $user = User::create(
                [
                    'type' => User::TYPE_USER,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => \Hash::make(rand(100000, 999999)),
                    'email_verified_at' => now(),
                    'active' => true,
                ]
            );
            $user->assignRole(User::ROLE_CUSTOMER);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
