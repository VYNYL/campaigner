<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\DTO\OrdersCollection;
use Vynyl\Campaigner\DTO\Order;
use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\Responses\OrdersResponse;

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
        $response = $this->connection->post(
            '/Orders/Import',
            $payload
        );
        $body = $response->getBody();
        $ordersResponse = null;
        if (!empty($body['ErrorCode'])) {
            $ordersResponse = (new ErrorResponse())
                ->setErrorCode($body['ErrorCode'])
                ->setMessage($body['Message'])
                ->setIsError(true);
        } else {
            $ordersResponse = new OrdersResponse();
            if (!empty($body['Failures'])) {
                foreach ($body['Failures'] as $failure) {
                    $orderError = (new OrderError())
                        ->setEmailAddress($failure['EmailAddress'])
                        ->setOrderNumber($failure['OrderNumber'])
                        ->setErrorCode($failure['ErrorCode'])
                        ->setMessage($failure['Message']);
                    $ordersResponse->addError($orderError);
                }
            }
            $ordersResponse
                ->setOrdersSubmitted($body['OrdersSubmitted'])
                ->setSuccesses($body['Successes']);
        }
        return $ordersResponse;
    }

}
