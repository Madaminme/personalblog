<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
        public function __invoke(RegisterRequest $request)
    {
        return $this->execute(function () use ($request){
            $user = User::query()->create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $token = $user->createToken('api_token')->plainTextToken;
            return AuthResource::make(['user'=>$user,'token'=>$token]);
        },UserResponseEnum::USER_REGISTER);
    }
}
