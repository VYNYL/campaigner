<?php

namespace Vynyl\Campaigner\DTO;

class Order implements Postable
{
   
    private $emailAddress;

    private $orderNumber;

    private $purchaseDate;

    private $orderItems;

    public function __construct()
    {
        $this->orderItems = new OrderItemsCollection();
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param mixed $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @param mixed $purchaseDate
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return OrderItemsCollection
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    public function toPost()
    {
        return [
            'EmailAddress' => $this->getEmailAddress(),
            'SKU' => $this->getSku(),
            'OrderItems' => $this->orderItems->toArray(),
        ];
    }

}
