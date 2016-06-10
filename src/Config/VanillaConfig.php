<?php

namespace Vynyl\Campaigner\Config;

use \Exception;

class VanillaConfig implements Config
{

    private $config;

    public function __construct()
    {
        $configFile = __DIR__ . '/../../config.php';
        if (!file_exists($configFile)) {
            throw new Exception("Configuration file does not exist.  Please copy config.example.php to config.php and try again");
        }
        $this->config = require($configFile);
    }
    public function getBaseUrl()
    {
        return $this->get('base_url');
    }

    public function getApiKey()
    {
        return $this->get('api_key');
    }

    public function get($key)
{
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        throw new Exception("Configuration key $key does not exist.");
    }

}
