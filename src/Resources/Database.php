<?php

namespace Vynyl\Campaigner\Resources;


use Vynyl\Campaigner\DTO\DatabaseColumn;
use Vynyl\Campaigner\Connection;

class Database
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
        $columns = $this->connection->get('/Database')->getBody();
        return $columns['DatabaseColumns'];
    }

    public function post(DatabaseColumn $databaseColumn)
    {
        $payload = $databaseColumn->toPost();

        return $this->connection->post(
            '/Database',
            $payload
        );
    }

}
