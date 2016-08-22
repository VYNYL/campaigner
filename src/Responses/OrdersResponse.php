<?php

namespace Vynyl\Campaigner\Responses;

class OrdersResponse extends CampaignerResponse
{
    private $ordersSubmitted = 0;

    private $successes = 0;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getOrdersSubmitted()
    {
        return $this->ordersSubmitted;
    }

    /**
     * @param int $ordersSubmitted
     */
    public function setOrdersSubmitted($ordersSubmitted)
    {
        $this->ordersSubmitted = $ordersSubmitted;
        return $this;
    }

    /**
     * @return int
     */
    public function getSuccesses()
    {
        return $this->successes;
    }

    /**
     * @param int $successes
     */
    public function setSuccesses($successes)
    {
        $this->successes = $successes;
        return $this;
    }

}
