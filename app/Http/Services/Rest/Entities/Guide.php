<?php

namespace App\Http\Services\Rest\Entities;

use App\Http\Services\Rest\RestService;

class Guide extends RestService
{
    public function __construct() {
        parent::__construct('/guides');
    }
}
