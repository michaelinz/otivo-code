<?php

namespace Src\Integrations;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AtlasApi { 
    private $client;
    private $baseUri;
    private $defaultOptions; 

    public function __construct() {
        $this->baseUri = getenv('ATLAS_API_BASE');
        $this->client = new Client(['base_uri' => $this->baseUri]);
        $this->defaultOptions = [
            'key'=>getenv('ATLAS_API_KEY'),
            'out'=>'json'
        ];
    }

    public function makeRequest(string $method, string $uri, array $options = []) {
        try {

            $options = [...$this->defaultOptions, ...$options];
            $response = $this->client->request($method, $uri, ['query'=>  $options]);

            // Retrieve the Content-Type header from the response
            $contentType = $response->getHeaderLine('Content-Type');

            // Retrieve the body content
            $bodyContent = (string) $response->getBody();

            // Check if the charset is UTF-16LE
            if (strpos($contentType, 'charset=utf-16le') !== false) {
                // Convert the encoding to UTF-8 if necessary
                $bodyContent = mb_convert_encoding($bodyContent, 'UTF-8', 'UTF-16LE');
            }

            // Decode the JSON data
            $decodedBody = json_decode($bodyContent, true);

            // Check for JSON decode errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('JSON decode error: ' . json_last_error_msg());
            }
            return $decodedBody;

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $errorBody = (string) $response->getBody();
                throw new \Exception("API request failed with status {$statusCode}: {$errorBody}");
            } else {
                throw new \Exception("API request failed: " . $e->getMessage());
            }
        }
    }
}