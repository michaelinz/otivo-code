<?php

namespace Src\Services;

use Src\Integrations\AtlasApi;

class AccomodationService{
    public function __construct () {

    }

    public function getAccomodationData($selectedlocationType, $selectedLocation, $pageNum = 1, $pageSize = 20)
    {

        $api = new AtlasApi();

        $params = [
            'cats' => 'ACCOMM',
            'pge' => $pageNum,
            'size' => $pageSize,
            $selectedlocationType => $selectedLocation
        ];

        return $api->makeRequest('GET', 'atlas/products', $params);
    }

}