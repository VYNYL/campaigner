<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\Product;
use Vynyl\Campaigner\Responses\ProductResponse;
use Vynyl\Campaigner\Responses\ErrorResponse;

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

    public function getBySku($sku)
    {
        $response = $this->connection->get('/Products/SKU/' . $sku);
        return $this->getProductResponseFromBody($response);;
    }

    public function put(Product $product)
    {
        $payload = $product->toPost();
        $response = $this->connection->put(
            '/Products/' . $product->getProductId(),
            $payload
        );
        return $this->getProductResponseFromBody($response);
    }

    public function post(Product $product)
    {
        $payload = $product->toPost();
        $response = $this->connection->post(
            '/Products',
            $payload
        );
        return $this->getProductResponseFromBody($response);
    }

    private function formProduct($body)
    {
        $product = new Product();
        $product->setProductId($body['ProductID'])
            ->setSku($body['SKU'])
            ->setProductName($body['ProductName'])
            ->setLongDescription($body['LongDescription'])
            ->setShortDescription($body['ShortDescription'])
            ->setProductURL($body['ProductURL'])
            ->setProductImage($body['ProductImage'])
            ->setWeight($body['Weight'])
            ->setCost($body['Cost'])
            ->setPrice($body['Price'])
            ->setActive($body['Active'])
            ->setCreated($body['Created'])
            ->setLastUpdated($body['LastUpdated']);
        return $product;
    }

    public function getProductResponseFromBody($response)
    {
        $body = $response->getBody();
        $productResponse = null;
        if (!empty($body['ErrorCode'])) {
            $productResponse = new ErrorResponse();
            $productResponse->setErrorCode($body['ErrorCode'])
                ->setMessage($body['Message'])
                ->setIsError(true);
        } else {
            $productResponse = new ProductResponse();
            $product = $this->formProduct($body);
            $productResponse->setProduct($product);
        }
        return $productResponse;
    }

    public function addProductToCategories($productId, $categoryIds)
    {
        $payload = [
            'Categories' => $categoryIds
        ];
        $response = $this->connection->post(
            '/Products/' . $productId . '/AddToCategories',
            $payload
        );
        return $this->getProductResponseFromBody($response);
    }

}
