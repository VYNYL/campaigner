<?php

namespace Vynyl\Campaigner\DTO;

interface ResourceCollection
{
    // ensures that each collection provides a way to serialize to array
    public function toArray();
}
