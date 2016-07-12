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
        $response = $this->client->request('GET', $url, [
                'headers' => $this->headers
            ]
        );
        // the Guzzle implementation has changed, so this is now required
        $body = (string) $response->getBody();
        return json_decode($body, true);
    }

    /**
     * Makes a POST request.
     * @param $resourceUri string
     * @param $payload string
     */
    public function post($resourceUri, $payload)
    {
        $url = $this->getFullUrl($resourceUri);
        $this->setHeader("Content-Type", "application/json");
        $json = json_encode($payload, JSON_PRETTY_PRINT);

        $response = $this->client->request('POST', $url, [
                'headers' => $this->headers,
                'body' => $json,
            ]
        );
        // the Guzzle implementation has changed, so this is now required
        $body = (string) $response->getBody();
        return json_decode($body, true);
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
