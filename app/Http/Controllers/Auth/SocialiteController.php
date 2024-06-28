<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sociallite as ModelsSocialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class SocialiteController extends Controller

#menggunakan $provider agar dinamik, tidak perlu satu satu google, fb, dll
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();


        // check if user already exists
        $registeredUser = User::where("google_id", $socialUser->id)->first();

        if(!$registeredUser){
            $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password'=> Hash::make('123'),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            Auth::login($user);

            return redirect('/landing'); //redirect to dashboard
        }

        Auth::login($registeredUser); //login the existing user

        return redirect('/landing');

}
}
