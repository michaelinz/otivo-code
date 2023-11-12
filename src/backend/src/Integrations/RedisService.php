<?php

namespace Src\Integrations;

use Predis\Client;

class RedisService { 

    public $connection; 

    public function __construct()
    {
        $this->connection = new Client([
            'scheme' => 'tcp',
            'host' => '52.62.219.134',
            'password' => 'largepass1101',
            'port' => 6379,
        ]);
    }
    
}