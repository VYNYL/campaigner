<?php

namespace Vynyl\Campaigner\Resources;


use PhpParser\Error;
use Vynyl\Campaigner\DTO\DatabaseColumn;
use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\DatabaseColumnCollection;
use Vynyl\Campaigner\Responses\DatabaseColumnAddResponse;
use Vynyl\Campaigner\Responses\DatabaseResponse;
use Vynyl\Campaigner\Responses\ErrorResponse;

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
            $payload
        );

        $body = $response->getBody();
        $databaseColumnResponse = null;
        if ($response->getStatusCode != 201) {
            $databaseColumnResponse = (new ErrorResponse())
                ->setErrorCode($body['ErrorCode'])
                ->setMessage($body['Message'])
                ->setIsError(true);
        } else {
            $databaseColumnResponse = (new DatabaseColumnAddResponse())
                ->setColumnName($body['ColumnName'])
                ->setColumnSize($body['ColumnSize'])
                ->setColumnType($body['ColumnType'])
                ->setIsCustom($body['IsCustom'])
                ->setVariable($body['Variable']);
        }
        return $databaseColumnResponse;
    }

}
