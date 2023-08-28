<?php

namespace App\Http\Services;

use App\Traits\ConsumesExternalService;
use Illuminate\Http\Response;

class Service
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the microservice
     * @var string
     */
    public $baseUri;

    /**
     * The request url to be used to connect to endpoint
     * @var string
     */
    public $requestUrl;

    public function __construct(String $confService) {
        $this->baseUri = config($confService);
    }

    public function getItems()
    {
        return $this->performRequest('GET', $this->requestUrl);
    }

    public function getItem($id)
    {
        return $this->performRequest('GET', $this->requestUrl.'/'.$id);
    }

    public function createItem($data)
    {
        return $this->performRequest('POST', $this->requestUrl, $data);
    }

    public function editItem($data, $id)
    {
        return $this->performRequest('PUT', $this->requestUrl.'/'.$id, $data);
    }

    public function deleteItem($data, $id)
    {
        return $this->performRequest('DELETE', $this->requestUrl.'/'.$id, $data);
    }
}
