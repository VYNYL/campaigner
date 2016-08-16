<?php

namespace Vynyl\Campaigner\DTO;


class MailingList
{
    private $listId;

    private $name;

    private $description;

    private $activeMembers;

    private $isActive;

    /**
     * @return mixed
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param mixed $listId
     * @return MailingList
     */
    public function setListId($listId)
    {
        $this->listId = $listId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return MailingList
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return MailingList
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActiveMembers()
    {
        return $this->activeMembers;
    }

    /**
     * @param mixed $activeMembers
     * @return MailingList
     */
    public function setActiveMembers($activeMembers)
    {
        $this->activeMembers = $activeMembers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return MailingList
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function toPost()
    {
        return [
            'ListID' => $this->getListId(),
            'Name' => $this->getName(),
        ];
    }

}
