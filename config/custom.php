<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'read_time' => env("READ_TIME_PER_MINUTE", 150),
    'max_comments' => env("MAX_LATEST_COMMENTS", 4),
    'frontend_host' => env("FRONTEND_HOST", "http://thedev.uz")
];
