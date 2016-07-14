<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\DTO\OrdersCollection;
use Vynyl\Campaigner\DTO\Order;
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

    public function getAll()
    {
        return $this->connection->get('/Orders');
    }

    public function updateOrder(Order $order)
    {
        $payload = $order->toPost();

        return $this->connection->put(
            '/Orders/' . $order->getOrderNumber(),
            $payload
        );
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
