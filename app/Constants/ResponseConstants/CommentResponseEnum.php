<?php

namespace App\Constants\ResponseConstants;

enum CommentResponseEnum:string implements ResponseInterface
{
    case COMMENT_LIST = "Comments List";
    case COMMENT_CREATED = "Comment created";
    case COMMENT_SHOW = "Comment information";
    case COMMENT_UPDATE = "Comment updated";
    case COMMENT_DELETE = "Comment deleted";
    case LAST_COMMENTS = "Last comments";
}
