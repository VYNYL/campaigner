<?php

namespace Vynyl\Campaigner;

use Vynyl\Campaigner\Config\Config;

/**
 * API Client for Campaigner.
 */
class API
{

    /**
     * Connection instance
     *
     * @var Connection
     */
    private $connection;

    /**
     * Object that implements Config interface.
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Get an instance of the HTTP connection object. Initializes
     * the connection if it is not already active.
     *
     * @return Connection
     */
    private function connection()
    {
        if (!$this->connection) {
            $this->connection = new Connection(
                $this->config->getBaseUrl(),
                $this->config->getApiKey()
            );
        }
        return $this->connection;
    }

    /**
     * Convenience method to return instance of the connection
     *
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection();
    }
}
