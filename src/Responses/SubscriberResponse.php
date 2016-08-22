<?php

namespace Vynyl\Campaigner\Responses;


class SubscriberResponse extends CampaignerResponse
{
    private $contactsSubmitted = 0;

    private $successes = 0;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getContactsSubmitted()
    {
        return $this->contactsSubmitted;
    }

    /**
     * @param int $contactsSubmitted
     */
    public function setContactsSubmitted($contactsSubmitted)
    {
        $this->contactsSubmitted = $contactsSubmitted;
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