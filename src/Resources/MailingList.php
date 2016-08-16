<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\MailingListCollection;
use Vynyl\Campaigner\Responses\MailingListResponse;

class MailingList extends Resource
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get()
    {
        $response = $this->connection->get('/Lists');
        $body = $response->getBody();
        $mailingLists = new MailingListCollection();
        foreach ($body['Lists'] as $list) {
            $mailingList = new \Vynyl\Campaigner\DTO\MailingList();
            $mailingList->setActiveMembers($list['ActiveMembers'])
                ->setDescription($list['Description'])
                ->setIsActive($list['IsActive'])
                ->setListId($list['ListID'])
                ->setName($list['Name']);
            $mailingLists->addMailingList($mailingList);
        }
        $mailingListResponse = new MailingListResponse();
        $mailingListResponse->setMailingLists($mailingLists);
        return $mailingListResponse;
    }

}
