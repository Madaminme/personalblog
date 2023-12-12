<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;

class RegisterController extends Controller
{
        public function __invoke(RegisterRequest $request)
    {
        return $this->execute(function () use ($request){
            $validated = $request->validated();
            $user = User::query()->create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            if ($request->hasFile('image')){
                $user->addMedia($validated['image'])->toMediaCollection('user-images');
            }
            $token = $user->createToken('api_token')->plainTextToken;
            return AuthResource::make(['user'=>$user,'token'=>$token]);
        },UserResponseEnum::USER_REGISTER);
    }
}
