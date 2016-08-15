<?php

namespace Vynyl\Campaigner\DTO;

class DatabaseColumnCollection implements ResourceCollection
{
    private $databaseColumns = [];

    public function __construct()
    {

    }

    public function addDatabaseColumn(DatabaseColumn $databaseColumn)
    {
        $this->databaseColumns[] = $databaseColumn;
    }

    public function getDatabaseColumns()
    {
        return $this->databaseColumns;
    }

    public function toArray()
    {
        $databaseColumns = [];
        foreach ($this->databaseColumns as $key => $databaseColumn) {
            $databaseColumns[] = $databaseColumn->toPost();
        }
        return $databaseColumns;
    }
}
