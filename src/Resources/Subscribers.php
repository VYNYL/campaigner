<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\SubscriberCollection;

class Subscribers extends Resource
{
    /**
 * @var Connection
 */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function addOrUpdateMultiple(SubscriberCollection $subscriberCollection)
    {
        return $this->connection->post(
            '/Import/AddOrUpdate',
            $subscriberCollection->toPost()
        );
    }
}
