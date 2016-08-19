<?php

namespace Vynyl\Campaigner\Responses;

use Vynyl\Campaigner\DTO\Product;


class ProductResponse extends CampaignerResponse
{
    private $product;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return ProductResponse
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

}
