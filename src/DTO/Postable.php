<?php

namespace Vynyl\Campaigner\DTO;

interface Postable
{
    // Method to prepare object for POST request
    public function toPost();
}
