<?php

namespace Src\Controllers;

use Src\Controllers\Controller;
use Src\Integrations\AtlasApi;
use Predis\Client;
use Src\Integrations\RedisService;

class LocationController extends Controller
{
    private $accomodationService;
    private $redis;

    public function __construct()
    {
        $this->redis = new RedisService();
    }

    public function indexSuburbs()
    {
        if ($this->redis->connection->exists('suburbs')) {
            $data = json_decode($this->redis->connection->get('suburbs'));
        } else {
            $api = new AtlasApi();

            $params = [
                'st' => 'nsw'
            ];

            $data = $api->makeRequest('GET', 'atlas/suburbs', $params);

            $this->redis->connection->set('suburbs', json_encode($data));
        }

        return $this->jsonResponse($data);
    }

    public function indexAreas()
    {
        if ($this->redis->connection->exists('areas')) {
            $data = json_decode($this->redis->connection->get('suburbs'));
        } else {

            $api = new AtlasApi();

            $params = [
                'st' => 'nsw'
            ];

            $data = $api->makeRequest('GET', 'atlas/areas', $params);

        }
        return $this->jsonResponse($data);
    }
}