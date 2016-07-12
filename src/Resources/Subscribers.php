<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\Subscriber;
use Vynyl\Campaigner\DTO\SubscriberCollection;

class Subscribers extends Resource
{
    /**
 * @var Connection
 */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function addOrUpdateMultiple(SubscriberCollection $subscriberCollection)
    {
        $payload = $subscriberCollection->toPost();

        return $this->connection->post(
            '/Import/AddOrUpdate',
            $payload
        );
    }

    public function post(Subscriber $subscriber)
    {
        $payload = $subscriber->toPost();

        return $this->connection->post(
            '/Subscribers',
            $payload
        );
    }
}
