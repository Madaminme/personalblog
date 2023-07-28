<?php

namespace App\Http\Controllers\User;

use App\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function (){
            $users = User::all();
            return UserResource::collection($users);
        }, UserResponseEnum::USERS_LIST);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        return $this->execute(function () use($request){
            $validated = $request->validated();
            $user = User::query()->create($validated);
            return UserResource::make($user);
        }, UserResponseEnum::USER_CREATE);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->execute(function () use ($user){
            return UserResource::make($user);
        }, UserResponseEnum::USER_SHOW);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        return $this->execute(function () use ($request, $user){
            $user->update($request->validated());
            return UserResource::make($user);
        }, UserResponseEnum::USER_UPDATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $this->execute(function () use ($user){
            $user->delete();
        }, UserResponseEnum::USER_DELETED);
    }
}
