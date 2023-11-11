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


        $data = $this->accomodationService->getAccomodationData();

        return $this->jsonResponse($data);
    }

}