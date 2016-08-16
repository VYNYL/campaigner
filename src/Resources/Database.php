<?php

namespace Vynyl\Campaigner\Resources;


use Vynyl\Campaigner\DTO\DatabaseColumn;
use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\DatabaseColumnCollection;
use Vynyl\Campaigner\Responses\DatabaseResponse;

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
        $response = $this->connection->get('/Database');
        $body = $response->getBody();
        $databaseColumns = new DatabaseColumnCollection();
        foreach ($body['DatabaseColumns'] as $column) {
            $databaseColumn = new DatabaseColumn();
            $databaseColumn->setColumnName($column['ColumnName'])
                ->setColumnSize($column['ColumnSize'])
                ->setColumnType($column['ColumnType'])
                ->setIsCustom($column['IsCustom'])
                ->setVariable($column['Variable']);
            $databaseColumns->addDatabaseColumn($databaseColumn);
        }
        $databaseResponse = new DatabaseResponse();
        $databaseResponse->setDatabaseColumns($databaseColumns);
        return $databaseResponse;
    }

    public function post(DatabaseColumn $databaseColumn)
    {
        $payload = $databaseColumn->toPost();

        $response = $this->connection->post(
            '/Database',
            $payload,
            new DatabaseColumnAddResponse()
        );

        return $response;
    }

}
