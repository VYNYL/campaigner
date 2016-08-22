<?php

namespace Vynyl\Campaigner\Responses;

class ErrorResponse extends CampaignerResponse
{
    private $errorCode;

    private $message;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     * @return ErrorResponse
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return ErrorResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
