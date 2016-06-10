<?php

namespace Vynyl\CampaignerTest;

use \Vynyl\Campaigner\API;
use \Vynyl\Campaigner\Config\VanillaConfig;

class ApiTest extends TestCase
{
    /**
     * Instance of the API to run tests with.
     * @var \Vynyl\Campaigner\API
     */
    private $api;

    /**
     * Instance of config object.
     * @var \Vynyl\Campaigner\Config\Config
     */
    private $config;

    /**
     * Instance of connection we use to retrieve resources.
     * @var \Vynyl\Campaigner\Connection
     */
    private $connection;

    public function setUp()
    {
        $this->config = new VanillaConfig();
        $this->api = new API($this->config);
        $this->connection = $this->api->getConnection();
    }

    /**
     * Testing basic connection to the API.  Any valid endpoint can be used.
     * @test
     */
    public function testAPIConnects()
    {
        $response = $this->connection->get('/Products');
        $this->assertEquals(
            self::HTTP_OK,
            $response->getStatusCode()
        );
    }
}
