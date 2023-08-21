<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        return $this->execute(function () use ($request){
            if (auth()->attempt($request->validated())) {
                /** @var User $user */
                $user = auth()->user();
                $token = $user->createToken('api_token')->plainTextToken;
                return AuthResource::make(['user' => $user, 'token' => $token,]);
            }
            return throw new \Exception('Unauthorized');
        }, UserResponseEnum::USER_LOGIN);
        }
}
