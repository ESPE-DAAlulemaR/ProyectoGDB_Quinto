<?php

namespace App\Http\Services\Rest;

use App\Http\Services\Service;

class RestService extends Service
{
    public function __construct(String $endpoint) {
        parent::__construct('services.micro_rest.base_uri');
        $this->requestUrl = $endpoint;
    }
}
