<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;

class MailingList extends Resource
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
        return $this->connection->get('Lists');
    }
}
