<?php

namespace Src\Controllers;

use Src\Controllers\Controller;
use Src\Services\AccomodationService;

class TestController extends Controller
{
    private $accomodationService;

    public function __construct()
    {
        $this->accomodationService = new AccomodationService();
    }

    public function index()
    {
        $queryParams = [];
        parse_str($_SERVER['QUERY_STRING'], $queryParams);

        $selectedlocationType = (string) isset($queryParams['locationType']) ? urldecode($queryParams['locationType']) : '' ;
        $selectedLocation = (string) isset($queryParams['location']) ? urldecode($queryParams['location']) : '';
        $currentPage = (int) isset($queryParams['currentPage']) ? $queryParams['currentPage'] : 1;
        $pageSize = (int) isset($queryParams['pageSize']) ? $queryParams['pageSize'] : 20;


        if ($selectedlocationType !== 'ct' && $selectedlocationType !== 'ar' && $selectedlocationType !== '') {
            return $this->errorResponse('Invalid location type', 400);
        }

        $data = $this->accomodationService->getAccomodationData(
            (string) $selectedlocationType,
            (string) $selectedLocation,
            (int) $currentPage,
            (int )$pageSize
        );

        return $this->jsonResponse($data);
    }

}