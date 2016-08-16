<?php
/**
 * Created by PhpStorm.
 * User: jasonallen
 * Date: 8/16/16
 * Time: 12:28 PM
 */

namespace Vynyl\Campaigner\Responses;


use Vynyl\Campaigner\DTO\MailingListCollection;

class MailingListResponse extends CampaignerResponse
{
    private $mailingLists;

    public function __construct()
    {

    }

    public function setMailingLists(MailingListCollection $mailingLists)
    {
        $this->mailingLists = $mailingLists;
    }

    public function getMailingLists()
    {
        return $this->mailingLists->getMailingLists();
    }

}
