<?php

namespace Vynyl\Campaigner\DTO;

class Subscriber implements Postable
{
    private $emailAddress;

    private $customFields;

    private $sourceId;

    private $publications = [];

    private $lists = [];

    private $autoresponderId;

    private $orders;

    private $force = false;

    private $forcePublication = false;

    public function __construct()
    {
        $this->customFields = new CustomFieldsCollection();
        $this->orders = new OrdersCollection();
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
     * @return Subscriber
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSourceId()
    {
        return $this->sourceId;
    }

    /**
     * @param mixed $sourceId
     * @return Subscriber
     */
    public function setSourceId($sourceId)
    {
        $this->sourceId = $sourceId;
        return $this;
    }

    /**
     * @return array
     */
    public function getPublications()
    {
        return $this->publications;
    }

    /**
     * @param array $publications
     * @return Subscriber
     */
    public function addPublication($publicationId)
    {
        $this->publications[] = $publicationId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * @param mixed $lists
     * @return Subscriber
     */
    public function addList($listId)
    {
        $this->lists[] = $listId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAutoresponderId()
    {
        return $this->autoresponderId;
    }

    /**
     * @param mixed $autoresponderId
     * @return Subscriber
     */
    public function setAutoresponderId($autoresponderId)
    {
        $this->autoresponderId = $autoresponderId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isForce()
    {
        return $this->force;
    }

    /**
     * @param boolean $force
     * @return Subscriber
     */
    public function setForce($force)
    {
        $this->force = $force;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isForcePublication()
    {
        return $this->forcePublication;
    }

    /**
     * @param boolean $forcePublication
     * @return Subscriber
     */
    public function setForcePublication($forcePublication)
    {
        $this->forcePublication = $forcePublication;
        return $this;
    }


    public function toPost()
    {
        return [
            'EmailAddress' => $this->getEmailAddress(),
            'CustomFields' => $this->customFields->toArray(),
            'SourceID' => $this->getSourceId(),
            'Publications' => $this->getPublications(),
            'Lists' => $this->getLists(),
            'AutoResponderId' => $this->getAutoresponderId(),
            'Orders' => $this->orders->toArray(),
            'Force' => $this->isForce(),
            'ForcePublications' => $this->isForcePublication(),
        ];
    }
}
