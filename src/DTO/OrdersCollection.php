<?php

namespace Vynyl\Campaigner\DTO;

class OrdersCollection implements ResourceCollection
{
    private $orders = [];

    public function __construct()
    {

    }

    public function addOrder(Order $order)
    {
        $this->orders[] = $order;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function toArray()
    {
        $orders = [];
        foreach ($this->orders as $key => $order) {
            $orders[] = [
                // TODO: fill in orders...
            ];
        }
        return $orders;
    }
}
