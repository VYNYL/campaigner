<?php

namespace Vynyl\Campaigner\Resources;


use Vynyl\Campaigner\DTO\OrdersCollection;

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
        return $this->connection->post(
            '/Orders/Import',
            $ordersCollection->toPost()
        );
    }

}
