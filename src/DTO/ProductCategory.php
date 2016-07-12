<?php

namespace Vynyl\Campaigner\DTO;

class ProductCategory implements Postable
{

    private $name;

    private $description;

    private $image;

    private $url;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ProductCategory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return ProductCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return ProductCategory
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return ProductCategory
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function toPost()
    {
        return [
            'Name' => $this->getName(),
            'Description' => $this->getDescription(),
            'Image' => $this->getImage(),
            'URL' => $this->getUrl(),
        ];
    }

}
