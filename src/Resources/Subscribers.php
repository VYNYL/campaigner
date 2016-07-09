<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\DTO\SubscriberCollection;

class Subscribers extends Resource
{
    public function addOrUpdateMultiple(SubscriberCollection $subscriberCollection)
    {
        return $this->connection->post(
            '/Import/AddOrUpdate',
            $subscriberCollection->toPost()
        );
    }
}
