<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\DTO\OrdersCollection;
use Vynyl\Campaigner\Connection;

class Orders
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function addMultiple(OrdersCollection $ordersCollection)
    {
        $payload = $ordersCollection->toPost();

        return $this->connection->post(
            '/Orders/Import',
            $payload
        );
        
    }

}
