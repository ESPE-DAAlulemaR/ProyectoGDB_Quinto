<?php

namespace App\Http\Services\Rest\Entities;

use App\Http\Services\Rest\RestService;

class Zone extends RestService
{
    public function __construct() {
        parent::__construct('/zones');
    }
}
