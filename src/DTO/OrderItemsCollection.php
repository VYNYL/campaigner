<?php
/**
 * Created by PhpStorm.
 * User: jasonallen
 * Date: 7/11/16
 * Time: 2:59 PM
 */

namespace Vynyl\Campaigner\DTO;


class OrderItemsCollection implements ResourceCollection
{
    private $orderItems = [];
    
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