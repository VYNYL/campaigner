<?php

namespace Vynyl\Campaigner\Responses;

use Vynyl\Campaigner\DTO\DatabaseColumnCollection;

class DatabaseResponse extends CampaignerResponse
{
    private $databaseColumns;

    public function __construct()
    {
    }

    public function setDatabaseColumns(DatabaseColumnCollection $databaseColumns)
    {
        $this->databaseColumns = $databaseColumns;
    }

    public function getDatabaseColumns()
    {
        return $this->databaseColumns->getDatabaseColumns();
    }
}
