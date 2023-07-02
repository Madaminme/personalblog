<?php

namespace App\Constants\ResponseConstants;

enum NewsletterResponseEnum:string implements ResponseInterface
{
    case NEWSLETTER_LIST = "Newsletter list";

    case NEWSLETTER_CREATE = "Newsletter created";
}
