<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function redirect($provider)
    {
        $SocialiteUser = Socialite::driver($provider)->user();
        $user = User::updateOrCreate([
            'provider' => $provider,
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
}
