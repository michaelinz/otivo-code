<?php

namespace Src\Controllers;

use Src\Controllers\Controller;
use Src\Integrations\AtlasApi;

class LocationController extends Controller
{
    private $accomodationService;

    public function __construct()
    {
    }

    public function indexSuburbs()
    {
        $api = new AtlasApi();

        $params = [
            'st'=>'nsw'
        ];

        $data= $api->makeRequest('GET', 'atlas/suburbs', $params);

        return $this->jsonResponse($data);
    }

    public function indexAreas()
    {
        $api = new AtlasApi();

        $params = [
            'st'=>'nsw'
        ];

        $data= $api->makeRequest('GET', 'atlas/areas', $params);
        return $this->jsonResponse($data);

    }
}