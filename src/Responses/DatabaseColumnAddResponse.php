<?php

namespace Vynyl\Campaigner\Responses;

use Vynyl\Campaigner\DTO\DatabaseColumn;

class DatabaseColumnAddResponse extends CampaignerResponse
{
    private $databaseColumn;

    public function __construct()
    {

    }

    public function setDatabaseColumn(DatabaseColumn $databaseColumn)
    {
        $this->databaseColumn = $databaseColumn;
    }
}
