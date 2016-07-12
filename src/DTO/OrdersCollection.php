<?php

namespace Vynyl\Campaigner\DTO;

class OrdersCollection implements ResourceCollection, Postable
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
            $orders[] = $order->toPost();
        }
        return $orders;
    }

    public function toPost()
    {

        return [ "Orders" => $this->toArray() ];
    }
}
