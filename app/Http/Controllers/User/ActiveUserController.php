<?php

namespace App\Http\Controllers\User;

use App\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\ActiveUsersResource;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function __invoke()
    {
        return $this->execute(function (){
            $users = User::query()->withCount('posts')
                ->orderByDesc('posts_count')
                ->limit(5)->get();
            return ActiveUsersResource::collection($users);
        }, UserResponseEnum::ACTIVE_USERS);
    }
}
