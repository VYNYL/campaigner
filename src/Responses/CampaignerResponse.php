<?php

namespace Vynyl\Campaigner\Responses;

class CampaignerResponse
{
    protected $errors = [];

    protected $isError = false;

    public function __construct()
    {

    }

    public function hasErrors()
    {
        return count($this->errors);
    }

    public function isError()
    {
        return $this->isError;
    }

    public function setIsErrors($isError)
    {
        $this->isError = $isError;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError(Error $error)
    {
        $this->errors[] = $error;
    }
}
