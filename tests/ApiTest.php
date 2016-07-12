<?php

namespace Vynyl\CampaignerTest;

use \DateTime;
use \Vynyl\Campaigner\API;
use \Vynyl\Campaigner\Config\VanillaConfig;
use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\Order;
use Vynyl\Campaigner\DTO\OrderItem;
use Vynyl\Campaigner\DTO\OrdersCollection;
use Vynyl\Campaigner\DTO\Product;
use Vynyl\Campaigner\DTO\ProductCategory;
use Vynyl\Campaigner\DTO\Subscriber;
use Vynyl\Campaigner\DTO\SubscriberCollection;
use Vynyl\Campaigner\Resources\Orders;
use Vynyl\Campaigner\Resources\ProductCategories;
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

    public function testAddProductCategoryAndProduct(Connection $connection)
    {
        $productCategory = new ProductCategory();
        $productCategory->setName("name")
            ->setDescription("description")
            ->setImage("image")
            ->setUrl("url");

        $productCategoryResource = new ProductCategories($connection);
        $categoryResponse = $productCategoryResource->post($productCategory);
        $categoryId = $categoryResponse['CategoryID'];

        $product = new Product();
        $product->addCategory($categoryId);
        $product->setCost("2")
            ->setLongDescription("long description")
            ->setPrice("3")
            ->setProductImage("image")
            ->setProductName("NEWWW")
            ->setProductURL("url")
            ->setShortDescription("short description")
            ->setSku("sku")
            ->setWeight("2");

        $productResource = new Products($connection);
        return $productResource->post($product);
    }

    public function testImportMultipleOrders(Connection $connection)
    {
        $orders = new OrdersCollection();

        $order1 = new Order();
        $order1->setEmailAddress("nnorton@vynyl.com")
           ->setOrderNumber("jasldkjf")
           ->setPurchaseDate("12/1/2011");

        $orderItem1 = new OrderItem();
        $orderItem1->setProductName("name")
            ->setSku("1218")
            ->setQuantity("2")
            ->setUnitPrice("3.33")
            ->setWeight("8.1")
            ->setStatus("0");
        $order1->getOrderItems()->addOrderItem($orderItem1);

        $orderItem2 = new OrderItem();
        $orderItem2->setProductName("new prod")
            ->setSku("23456")
            ->setQuantity("3")
            ->setUnitPrice("4.33")
            ->setWeight("2.1")
            ->setStatus("0");
        $order1->getOrderItems()->addOrderItem($orderItem2);

        $order2 = new Order();
        $order2->setEmailAddress("nnorton@vynyl.com")
            ->setOrderNumber("1004")
            ->setPurchaseDate("2011-08-10");

        $orderItem3 = new OrderItem();
        $orderItem3->setProductName("new_product")
            ->setSku("1235456")
            ->setQuantity("3")
            ->setUnitPrice("3")
            ->setWeight("3")
            ->setStatus("3");
        $order2->getOrderItems()->addOrderItem($orderItem3);

        $orders->addOrder($order1);
        $orders->addOrder($order2);

        $ordersResource = new Orders($connection);

        return $ordersResource->addMultiple($orders);
    }

}
