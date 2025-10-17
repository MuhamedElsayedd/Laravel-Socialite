<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function login()
    {
        return Socialite::driver('github')->redirect();
    }

    public function redirect()
    {
        $SocialiteUser = Socialite::driver('github')->user();
        $user = User::updateOrCreate([
            'provider_id' => $SocialiteUser->getId(),
        ], [
            'name' => $SocialiteUser->getName(),
            'email' => $SocialiteUser->getEmail(),

        ]);


        // auth User
        Auth::login($user, true);

        // redirect to dashboard
        return to_route('dashboard');
    }


    public function dribbble_login()
    {
        return Socialite::driver('dribbble')->redirect();
    }

    public function dribbble_redirect()
    {
        $SocialiteUser = Socialite::driver('dribbble')->user();
        $user = User::updateOrCreate([
            'dribbble_id' => $SocialiteUser->getId(),
        ], [
            'name' => $SocialiteUser->getName(),
            'email' => $SocialiteUser->getEmail(),

        ]);


        // auth User
        Auth::login($user, true);

        // redirect to dashboard
        return to_route('dashboard');
    }
}
