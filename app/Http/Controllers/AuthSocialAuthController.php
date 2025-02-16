<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialAuthController extends Controller
{
    /**
     * Перенаправление пользователя на GitHub для аутентификации.
     */
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Обработка ответа от GitHub.
     */
    public function handleGitHubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName(),
                'password' => bcrypt(str()->random(16)), // Генерируем случайный пароль
                'github_id' => $githubUser->getId(),
            ]
        );

        Auth::login($user);

        return redirect('/');
    }
}
