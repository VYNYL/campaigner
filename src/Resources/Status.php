<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;

class Status extends Resource
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get()
    {
        // TODO: create a full response object for this
        $response = $this->connection->get('/ping');
        if ($response->getStatusCode() == 200) {
            return true;
        }
        return false;
    }
}
