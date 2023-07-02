<?php

namespace App\Constants\ResponseConstants;

enum ProjectResponseEnum: string implements ResponseInterface
{
    case PROJECT_LIST = "Project list";

    case PROJECT_CREATE = "Project created";

    case PROJECT_SHOW = "Project information";

    case PROJECT_UPDATE = "Project updated";

    case PROJECT_DELETE = "Project deleted";
}
