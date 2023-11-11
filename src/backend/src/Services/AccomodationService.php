<?php

namespace Src\Services;

use Src\Integrations\AtlasApi;

class AccomodationService{ 
    public function __construct () { 

    }

    public function getAccomodationData(){

        $api = new AtlasApi();

        $params = [
            'cats'=>'ACCOMM',
            'pge'=>1,
            'size'=>20
        ];


        return $api->makeRequest('GET', 'atlas/products', $params);
    }

}