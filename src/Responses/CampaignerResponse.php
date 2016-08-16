<?php

namespace Vynyl\Campaigner\Responses;

class CampaignerResponse
{
    protected $errors = [];

    public function __construct()
    {

    }

    public function hasErrors()
    {
        return count($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }
}
