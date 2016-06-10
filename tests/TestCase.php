<?php

namespace Vynyl\CampaignerTest;

use Lukasoppermann\Httpstatus\Httpstatuscodes;

class TestCase extends \PHPUnit_Framework_TestCase implements Httpstatuscodes
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Convert API response to array
     *
     * @return array
     */
    public function getResponseArray($response)
    {
        $contents = json_decode($response->getBody()->getContents(), true);
        return $contents;
    }
}
