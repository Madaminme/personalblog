<?php

namespace App\Constants\ResponseConstants;

enum ContactResponseEnum:string implements ResponseInterface
{
    case CONTACT_LIST = "Contact list";

    case CONTACT_CREATE = "Contact created";
}
