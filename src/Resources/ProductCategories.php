<?php

namespace Vynyl\Campaigner\Resources;

use Vynyl\Campaigner\Connection;
use Vynyl\Campaigner\DTO\ProductCategory;
use Vynyl\Campaigner\Responses\ProductCategoryResponse;
use Vynyl\Campaigner\Responses\ErrorResponse;

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

    // this is only returning information for the root object for now
    public function get()
    {
        $response = $this->connection->get('/ProductCategories');
        $body = $response->getBody();
        return $this->getResponseFromBody($body);
    }

    public function post(ProductCategory $productCategory)
    {
        $payload = $productCategory->toPost();
        $parentId = $productCategory->getParentId();
        $urlExtension = $parentId == -1 ? '' : '/' . $parentId;

        $response = $this->connection->post(
            '/ProductCategories' . $urlExtension,
            $payload
        );
        $body = $response->getBody();
        return $this->getResponseFromBody($body);
    }

    public function put(ProductCategory $productCategory)
    {
        $payload = $productCategory->toPost();

        $response = $this->connection->put(
            '/ProductCategories/' . $productCategory->getParentId(),
            $payload
        );
        $body = $response->getBody();
        return $this->getResponseFromBody($body);
    }

    public function getCategoryByName($name)
    {
        $response = $this->connection->get('/ProductCategories?categoryName=' . $name);
        $body = $response->getBody()[0];
        return $this->getResponseFromBody($body);
    }

    public function getResponseFromBody($body)
    {
        $categoryResponse = null;
        if (!empty($body['ErrorCode'])) {
            $categoryResponse = new ErrorResponse();
            $categoryResponse->setErrorCode($body['ErrorCode'])
                ->setMessage($body['Message'])
                ->setIsError(true);
        } else {
            $categoryResponse = new ProductCategoryResponse();
            $productCategory = new ProductCategory();
            $productCategory->setDescription($body['Description'])
                ->setImage($body['Image'])
                ->setName($body['Name'])
                ->setUrl($body['URL'])
                ->setId($body['CategoryID']);
            $categoryResponse->setProductCategory($productCategory);
        }
        return $categoryResponse;
    }

}
