<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\Subscriber;
use Vynyl\Campaigner\DTO\SubscriberCollection;
use Vynyl\Campaigner\Responses\SubscriberError;
use Vynyl\Campaigner\Responses\SubscriberResponse;

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
        $response = $this->connection->post(
            '/Import/AddOrUpdate',
            $payload
        );
        $body = $response->getBody();
        $subscriberResponse = null;
        if (!empty($body['ErrorCode'])) {
            $subscriberResponse = (new ErrorResponse())
                ->setErrorCode($body['ErrorCode'])
                ->setMessage($body['Message'])
                ->setIsError(true);
        }
        else {
            $subscriberResponse = new SubscriberResponse();
            if (!empty($body['Failures'])) {
                foreach ($body['Failures'] as $failure) {
                    $subscriberError = (new SubscriberError())
                        ->setEmailAddress($failure['EmailAddress'])
                        ->setErrorCode($failure['ErrorCode'])
                        ->setMessage($failure['Message']);
                    $subscriberResponse->addError($subscriberError);
                }
            }
            $subscriberResponse
                ->setContactsSubmitted($body['ContactsSubmitted'])
                ->setSuccesses($body['Successes']);
        }
        return $subscriberResponse;
    }

    // TODO: if/when we need this update to use new response object
    public function post(Subscriber $subscriber)
    {
        $payload = $subscriber->toPost();

        return $this->connection->post(
            '/Subscribers',
            $payload
        );
    }
}
