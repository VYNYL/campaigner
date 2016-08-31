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

        // if this is the root category, specify that by making the parentId -1 and it will make sure the URL doesn't
        // have a parent ID appended and instead posts straight to /ProductCategories/ for adding the root and not
        // /ProductCategories/{categoryId} where categoryId is the parent
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

        // this campaigner endpoint puts successes in an extra, single element array on successes so we have to unwrap it by grabbing the 0th index
        // failures do not so we don't have to worry about that
        if (array_key_exists(0, $response->getBody())) {
            $body = $response->getBody()[0];
        }
        else {
            $body = $response->getBody();
        }
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
