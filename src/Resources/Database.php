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
        $response = $this->connection->get('/Database', new DatabaseResponse());
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
        $response->setDatabaseColumns($databaseColumns);
        return $response;
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
