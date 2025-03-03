<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialAuthController extends Controller
{

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'password' => bcrypt(str()->random(16)),
                    "{$provider}_id" => $socialUser->getId(),
                ]
            );

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Ошибка авторизации через ' . ucfirst($provider));
        }
    }
}
