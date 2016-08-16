<?php

namespace Vynyl\Campaigner\Responses;

use Vynyl\Campaigner\DTO\Order;

class OrderResponse extends CampaignerResponse
{
    private $order;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return OrderResponse
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

}
