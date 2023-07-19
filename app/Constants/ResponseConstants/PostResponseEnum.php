<?php

namespace App\Constants\ResponseConstants;

enum PostResponseEnum: string implements ResponseInterface
{
    case POST_LIST = "Posts list";
    case POST_CREATE = "Post created";
    case POST_SHOW = "Post information";
    case POST_UPDATE = "Post updated";
    case POST_DELETE = "Post deleted";
    case POST_COMMENTS = "Post comments";
}
