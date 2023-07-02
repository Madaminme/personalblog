<?php
 namespace App\Constants\ResponseConstants;

 enum TagResponseEnum:string implements ResponseInterface

 {
     case TAG_LIST = "Tag list";
     case TAG_CREATE = "Tag created";
     case TAG_SHOW = "Tag information";
     case TAG_UPDATE = "Tag updated";
     case TAG_DELETE = "Tag deleted";
     case TAG_POPULAR = "Popular tags";
 }
