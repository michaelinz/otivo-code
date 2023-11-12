<?php

namespace Src\Integrations;

use Predis\Client;

class RedisService { 

    public $connection; 

    public function __construct()
    {
        $this->connection = new Client([
            'host' => getenv('REDIS_HOST'),
            'port' => getenv('REDIS_PORT'),
        ]);
    }
    
}