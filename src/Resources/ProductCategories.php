<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\ProductCategory;

class ProductCategories extends Resource
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
        return $this->connection->get('/ProductCategories');
    }

    public function post(ProductCategory $productCategory)
    {
        $payload = $productCategory->toPost();

        return $this->connection->post(
            '/ProductCategories',
            $payload
        );
    }

}
