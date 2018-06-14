<?php

namespace webshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="webshopBundle\Repository\productsRepository")
 */
class products
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    private $productName;

    /**
     * @var int
     *
     * @ORM\Column(name="product_price", type="integer")
     */
    private $productPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=true)
     */
    private $imageUrl;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return products
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productPrice
     *
     * @param integer $productPrice
     *
     * @return products
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get productPrice
     *
     * @return int
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return products
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return products
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return products
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }


    public function __toString()
    {
        return $this->getDescription();
    }
}

