<?php

namespace Vynyl\Campaigner\DTO;


class OrderItemsCollection implements ResourceCollection
{
    private $orderItems = [];

    public function __construct()
    {

    }
    
    public function addOrderItem(OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;
    }
    
    public function toArray()
    {
        $orderItems = [];
        foreach ($this->orderItems as $key => $orderItem) {
            $orderItems[] = $orderItem->toPost();
        }
        return $orderItems;
    }
}