<?php

namespace Vynyl\Campaigner\DTO;

class SubscriberCollection implements Postable, ResourceCollection
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

    public function toArray()
    {
        $subscribers = [];
        foreach ($this->subscribers as $key => $subscriber) {
            $subscribers[] = $subscriber->toPost();
        }
        return $subscribers;
    }

    public function toPost()
    {
        return [ "Subscribers" => $this->toArray() ];
    }

}
