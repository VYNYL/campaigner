<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\DTO\OrderItem;
use Vynyl\Campaigner\DTO\OrdersCollection;
use Vynyl\Campaigner\DTO\Order;
use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\Responses\OrderError;
use Vynyl\Campaigner\Responses\OrderResponse;
use Vynyl\Campaigner\Responses\OrdersResponse;
use Vynyl\Campaigner\Responses\ErrorResponse;

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

    // TODO: if we need this at some point, update to use the response object
    public function getAll()
    {
        return $this->connection->get('/Orders');
    }

    public function updateOrder(Order $order)
    {
        $payload = $order->toPost();

        $response = $this->connection->put(
            '/Orders/' . $order->getOrderNumber(),
            $payload
        );
        $body = $response->getBody();
        $orderResponse = null;
        if (!empty($body['ErrorCode'])) {
            $orderResponse = new ErrorResponse();
            $orderResponse->setErrorCode($body['ErrorCode'])
                ->setMessage($body['Message'])
                ->setIsError(true);
        } else {
            $orderResponse = new OrderResponse();
            $order = new Order();
            $order->setOrderNumber($body['OrderNumber'])
                ->setEmailAddress($body['EmailAddress'])
                ->setPurchaseDate($body['PurchaseDate'])
                ->setCreated($body['Created'])
                ->setLastUpdated($body['LastUpdated'])
                ->setTotalItems($body['TotalItems'])
                ->setTotalAmount($body['TotalAmount'])
                ->setTotalWeight($body['TotalWeight'])
                ->setIsActive($body['IsActive']);

            foreach ($body['OrderItems'] as $item) {
                $orderItem = new OrderItem();
                $orderItem->setOrderItemId($item['OrderItemID'])
                      ->setProductId($item['ProductID'])
                      ->setOrderNumber($item['OrderNumber'])
                      ->setEmailAddress($item['EmailAddress'])
                      ->setProductName($item['ProductName'])
                      ->setSku($item['SKU'])
                      ->setQuantity($item['Quantity'])
                      ->setUnitPrice($item['UnitPrice'])
                      ->setWeight($item['Weight'])
                      ->setStatus($item['Status'])
                      ->setTotalAmount($item['TotalAmount'])
                      ->setPurchaseDate($item['PurchaseDate'])
                      ->setCreated($item['Created'])
                      ->setLastUpdated($item['LastUpdated']);
                $order->getOrderItems()->addOrderItem($orderItem);
            }
            $orderResponse->setOrder($order);
        }
        return $orderResponse;
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
                    $orderError = new OrderError();
                    $orderError->setEmailAddress($failure['EmailAddress'])
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
