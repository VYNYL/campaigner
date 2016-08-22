<?php

namespace Vynyl\Campaigner\DTO;


class MailingListCollection
{

    private $mailingLists = [];

    public function __construct()
    {

    }

    public function addMailingList(MailingList $mailingList)
    {
        $this->mailingLists[] = $mailingList;
    }

    public function getMailingLists()
    {
        return $this->mailingLists;
    }

}