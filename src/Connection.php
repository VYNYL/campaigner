<?php

namespace Vynyl\Campaigner;

use \GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use Vynyl\Campaigner\Exceptions\CampaignerException;
use Vynyl\Campaigner\Exceptions\UnauthenticatedException;
use Vynyl\Campaigner\Responses\ApiResponse;
use Vynyl\Campaigner\Responses\CampaignerResponse;

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
     * Number of times to retry before throwing error.
     * @var integer
     */
    private $maxRetries = 2;

    /**
     * Number of times request has been retried.
     */
    private $autoRetries = 0;

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
     * @return CampaignerResponse
     */
    public function get($resourceUri)
    {
        $options = [
            'headers' => $this->headers,
        ];
        return $this->request('GET', $resourceUri, $options);
    }
    
    /**
     * Makes a DELETE request.
     * @param $resourceUri string
     * @return CampaignerResponse
     */
    public function delete($resourceUri)
    {
        $options = [
        'headers' => $this->headers,
        ];
        return $this->request('DELETE', $resourceUri, $options);
    }

    /**
     * Makes a POST request.
     * @param $resourceUri string
     * @param $payload string
     */
    public function post($resourceUri, $payload)
    {
        $this->setHeader("Content-Type", "application/json");
        $options = [
            'headers' => $this->headers,
            'body' => json_encode($payload),
        ];
        return $this->request('POST', $resourceUri, $options);
    }

    /**
     * Makes a PUT request.
     * @param $resourceUri string
     * @param $payload string
     */
    public function put($resourceUri, $payload)
    {
        $this->setHeader("Content-Type", "application/json");
        $options = [
            'headers' => $this->headers,
            'body' => json_encode($payload),
        ];
        return $this->request('PUT', $resourceUri, $options);
    }

    public function request($method, $resourceUri, $options)
    {
        $url = $this->getFullURL($resourceUri);
        $response = null;
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (RequestException $e) {
            // guzzle throws a RequestException on 400 responses, which we need to be able to handle gracefully without blowing up
            if ($e->getResponse()->getStatusCode() == '400') {
                return $this->buildResponse($e->getResponse());
            }
        } catch (ServerException $e) {
            throw new CampaignerException("An error occurred while accessing the Campaigner API");
        }
        if (empty($response)) {
            // we received an empty response.  what's up with that?!
            if ($this->autoRetries > $this->maxRetries) {
                throw new UnauthenticatedException('No response from server at ' . $method . ' ' . $url . ' with payload ' . print_r($options, true));
            }
            $this->autoRetries++;
            // Sleep for 3 seconds in case empty response was due to an availability issue
            sleep(3);
            return $this->request($method, $resourceUri, $options);
        }
        $this->autoRetries = 0;
        $campaignerResponse = $this->buildResponse($response);
        return $campaignerResponse;
    }

    /**
     * @param Response $response
     */
    public function buildResponse(Response $response)
    {
        // the Guzzle implementation has changed to PSR-7, so casting to string is now required to bypass streaming interface
        $body = (string) $response->getBody();

        $apiResponse = new ApiResponse();
        $apiResponse->setBody(json_decode($body, true))
            ->setStatusCode($response->getStatusCode());
        return $apiResponse;
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
