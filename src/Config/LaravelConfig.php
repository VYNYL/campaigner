<?php

namespace Vynyl\Campaigner\Config;

class LaravelConfig implements Config
{
    private $apiKey;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = \Illuminate\Support\Facades\Config::get('vynyl.campaigner.api_url');
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
