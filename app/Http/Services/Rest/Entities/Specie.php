<?php

namespace App\Http\Services\Rest\Entities;

use App\Http\Services\Rest\RestService;

class Specie extends RestService
{
    public function __construct() {
        parent::__construct('/species');
    }

    public function createSpecieWithCaregiver($data)
    {
        return $this->performRequest('POST', $this->requestUrl . '/caregiver', $data);
    }
}
