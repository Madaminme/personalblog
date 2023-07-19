<?php

namespace App\Constants\ResponseConstants;

enum TypeResponseEnum:string implements ResponseInterface{
    case TYPE_INDEX = "Type list";
    case TYPE_STORE = "Type created";
    case TYPE_SHOW = "Type information";
    case TYPE_UPDATE = "Type updated";
    case TYPE_DELETE = "Type deleted";
}
