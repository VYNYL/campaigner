<?php

namespace Vynyl\Campaigner\DTO;

class Order implements Postable
{

    private $emailAddress = "";

    private $orderNumber = "";

    private $purchaseDate = "";

    /**
     * @var OrderItemsCollection
     */
    private $orderItems;

    private $created = "";

    private $lastUpdated = "";

    private $totalItems = 0;

    private $totalAmount = 0;

    private $totalWeight = 0;

    private $isActive = true;

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
            'OrderNumber' => $this->getOrderNumber(),
            'PurchaseDate' => $this->getPurchaseDate(),
            'Items' => $this->orderItems->toArray(),
        ];

    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     * @return Order
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param string $lastUpdated
     * @return Order
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     * @return Order
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     * @return Order
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    /**
     * @param int $totalWeight
     * @return Order
     */
    public function setTotalWeight($totalWeight)
    {
        $this->totalWeight = $totalWeight;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     * @return Order
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

}
