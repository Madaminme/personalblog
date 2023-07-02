<?php

namespace App\Constants\ResponseConstants;

enum UserResponseEnum: string implements ResponseInterface
{
    case USERS_LIST = 'Users list';
    case USER_UPDATED = 'User updated';
    case USER_CREATE = 'User created';
    case USER_SHOW = 'User show';
    case USER_DELETED = 'User deleted';
    case USER_REGISTER = "User registered";
    case USER_LOGIN = "User login";
    case ERROR = "Something went wrong, check Logs!";
    case USER_LOGOUT = 'User successfully logout';
}
