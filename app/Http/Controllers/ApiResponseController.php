<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Util\ReturnsDefaults;
use App\Util\ValidateBack;

class ApiResponseController extends Controller
{
    use ApiResponse;
    use ValidateBack;
    use ReturnsDefaults;
}
