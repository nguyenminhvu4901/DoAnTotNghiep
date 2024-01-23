<?php

namespace App\Http\Controllers;

use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;

class GoogleLoginController extends Controller
{

    use AuthenticatesUsers;

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $temporaryPassword = rand(100000, 999999);

            $user = User::create([
                'type' => User::TYPE_USER,
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make($temporaryPassword),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            $user->assignRole(User::ROLE_CUSTOMER);

            Auth::attempt(['email' => $user->email, 'password' => $temporaryPassword]);
        } else {
            Auth::login($user);
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
