<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        try {

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'username' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken  ?? null,
            ]);
            Auth::login($user);
            $token = $user->createToken('api_token')->plainTextToken;
            $token_param = http_build_query(['token' =>$token]);
            $url = config('custom.frontend_host')."?".$token_param;
            return redirect($url);

        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }
}
