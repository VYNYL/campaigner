<?php

namespace Vynyl\Campaigner\DTO;

class SubscriberCollection implements Postable
{

    private $subscribers = [];

    public function __construct()
    {

    }

    public function addSubscriber(Subscriber $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    public function getSubscribers()
    {
        return $this->subscribers;
    }

    public function toPost()
    {
        $subscribers = [];
        // Since each postable subscriber returns itself in array form...
        foreach ($this->subscribers as $key => $subscriber) {
            $subscribers[] = $subscriber->toPost();
        }
        return $subscribers;
    }
}
