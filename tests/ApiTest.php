<?php

namespace Vynyl\CampaignerTest;

use \Vynyl\Campaigner\API;
use \Vynyl\Campaigner\Config\VanillaConfig;
use Vynyl\Campaigner\DTO\Subscriber;
use Vynyl\Campaigner\DTO\SubscriberCollection;
use Vynyl\Campaigner\Resources\Products;
use Vynyl\Campaigner\Resources\Subscribers;

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
//    public function testAPIConnects()
//    {
//        $response = $this->connection->get('/Products');
//        $this->assertEquals(
//            self::HTTP_OK,
//            $response->getStatusCode()
//        );
//    }

//    public function testAddProduct()
//    {
//        $products = new Products($this->connection);
//        $products->post(['ProductName' => 'someProduct']);
//    }

    public function testAddOrUpdateMultipleSubscribers()
    {

        $subscribers = new SubscriberCollection();
        $subscriber = new Subscriber();
        $subscriber->setEmailAddress('asdf@asdf.com')
            ->setSourceId(1);

        $subscribers->addSubscriber($subscriber);

        // add orders, order items, custom fields, etc...

        $subscribersResource = new Subscribers($this->connection);

        $subscribersResource->addOrUpdateMultiple($subscribers);
    }
}
