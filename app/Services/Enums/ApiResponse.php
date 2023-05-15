<?php

namespace App\Services\Enums;

enum ApiResponse: string
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
