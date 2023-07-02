<?php

 namespace App\Constants\ResponseConstants;

 enum CategoryResponseEnum: string implements ResponseInterface
 {
     case CATEGORY_LIST = "Category list";
     case CATEGORY_CREATE = "Category create";
     case CATEGORY_SHOW = "Category show";
     case CATEGORY_UPDATE = "Category updated";
     case CATEGORY_DELETE = "Category delete";
     case POPULAR_CATEGORY = "Popular categories";
 }
