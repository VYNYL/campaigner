<?php

namespace Vynyl\Campaigner;

use \GuzzleHttp\Client;

class Connection
{
    /**
     * Instance of Guzzle HTTP client.
     * @var \GuzzleHttp\Client
     */
    private $client;
    /**

     * API Key.
     * @var string
     */
    private $apiKey;

    /**
     * Base URL for API.
     * @var string
     */
    private $baseUrl;

    /**
     * Headers to be sent with request;
     * @var array
     */
    private $headers = [];

    public function __construct($baseUrl, $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
        ]);

        $this->setApiKey($this->apiKey);
    }

    /**
     * Sets header to value, replacing existing values.
     * @param $header
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * Makes a GET request.
     * @param $resourceUri string
     */
    public function get($resourceUri)
    {
        $url = $this->getFullURL($resourceUri);
        return $this->client->get($url, [
                'headers' => $this->headers
            ]
        );
    }

    public function post($resourceUri, $payload)
    {

    }

    public function getFullUrl($resourceUri)
    {
        return $this->baseUrl . $resourceUri;
    }

    public function setApiKey($apiKey)
    {
        $this->setHeader('ApiKey', $apiKey);
    }
}
