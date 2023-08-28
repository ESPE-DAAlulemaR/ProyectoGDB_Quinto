<?php

namespace App\Http\Services\Rest\Entities;

use App\Http\Services\Rest\RestService;

class Habitat extends RestService
{
    public function __construct() {
        parent::__construct('/habitats');
    }
}
