<?php

namespace Vynyl\Campaigner\DTO;


class Product implements Postable
{
    private $productId = 0;

    private $productName = "";

    private $sku = "";

    private $longDescription = "";

    private $shortDescription = "";

    private $productURL = "";

    private $productImage = "";

    private $weight = "";

    private $cost = 0;

    private $price = 0;

    private $active = true;

    private $created = "";

    private $lastUpdated = "";

    private $categories = [];

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param mixed $lastUpdated
     * @return Product
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     * @return Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * @param mixed $longDescription
     * @return Product
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param mixed $shortDescription
     * @return Product
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductURL()
    {
        return $this->productURL;
    }

    /**
     * @param mixed $productURL
     * @return Product
     */
    public function setProductURL($productURL)
    {
        $this->productURL = $productURL;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * @param mixed $productImage
     * @return Product
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     * @return Product
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function addCategory($id)
    {
        $this->categories[] = $id;
    }

    /**
     * @param array $categories
     * @return Product
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    public function toPost()
    {
        return [
            'ProductName' => $this->getProductName(),
            'SKU' => $this->getSku(),
            'LongDescription' => $this->getLongDescription(),
            'ShortDescription' => $this->getShortDescription(),
            'ProductURL' => $this->getProductURL(),
            'ProductImage' => $this->getProductImage(),
            'Weight' => $this->getWeight(),
            'Cost' => $this->getCost(),
            'Price' => $this->getPrice(),
            'Categories' => $this->getCategories(),
        ];
    }

}
