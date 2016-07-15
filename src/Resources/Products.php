<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\Product;

class Products extends Resource
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get()
    {
        return $this->connection->get('/Products');
    }

    public function put(Product $product)
    {
        $payload = $product->toPost();

        return $this->connection->put(
            '/Products/' . $product->getProductId(),
            $payload
        );
    }
    
    public function post(Product $product)
    {
        $payload = $product->toPost();

        return $this->connection->post(
            '/Products',
            $payload
        );
    }
    
}
