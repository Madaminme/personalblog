<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ResponseConstants\UserResponseEnum;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        return $this->execute(function () {
            auth()->user()->tokens()->delete();
        }, UserResponseEnum::USER_LOGOUT);
    }
}
