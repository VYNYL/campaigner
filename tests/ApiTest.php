<?php

namespace Vynyl\CampaignerTest;

use \DateTime;
use \Vynyl\Campaigner\API;
use \Vynyl\Campaigner\Config\VanillaConfig;
use Vynyl\Campaigner\DTO\Order;
use Vynyl\Campaigner\DTO\OrderItem;
use Vynyl\Campaigner\DTO\OrdersCollection;
use Vynyl\Campaigner\DTO\Subscriber;
use Vynyl\Campaigner\DTO\SubscriberCollection;
use Vynyl\Campaigner\Resources\Orders;
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
        $subscriber->setEmailAddress('nnorton@vynyl.com')
            ->setSourceId(1);

        $subscribers->addSubscriber($subscriber);

        // add orders, order items, custom fields, etc...

        $subscribersResource = new Subscribers($this->connection);

        $subscribersResource->addOrUpdateMultiple($subscribers);
    }

    public function testImportMultipleOrders()
    {
        $orders = new OrdersCollection();

        $order1 = new Order();

        $order1->setEmailAddress("nnorton@vynyl.com");
        $order1->setOrderNumber(22);
        $order1->setPurchaseDate(new DateTime());

        $orderItem1 = new OrderItem();
        $orderItem1->setProductName("name")
                    ->setSku("12345")
                    ->setQuantity("2")
                    ->setUnitPrice("3.33")
                    ->setWeight("8.1")
                    ->setStatus("sup");
        $order1->getOrderItems()->addOrderItem($orderItem1);

        $orderItem2 = new OrderItem();
        $orderItem2->setProductName("new prod")
            ->setSku("1234567")
            ->setQuantity("3")
            ->setUnitPrice("4.33")
            ->setWeight("2.1")
            ->setStatus("yoyo");
        $order1->getOrderItems()->addOrderItem($orderItem2);

        $order2 = new Order();

        $orderItem3 = new OrderItem();
        $orderItem3->setProductName("name")
            ->setSku("12345")
            ->setQuantity("2")
            ->setUnitPrice("3.33")
            ->setWeight("8.1")
            ->setStatus("sup");
        $order2->getOrderItems()->addOrderItem($orderItem3);

        
        $ordersResource = new Orders($this->connection);
        
        
        
        $ordersResource->addMultiple($orders);

    }

}
