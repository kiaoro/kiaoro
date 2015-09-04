<?php

namespace Naissance\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Naissance\ApplicationBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=false)
     */
    private $price;

    /**
     * @ORM\Column(name="currency", type="integer", options={"default":1})
     */
    private $currency;

    /**
     * @ORM\Column(name="page_url", type="string", nullable=false)
     */
    private $pageUrl;

    /**
     * @ORM\Column(name="image_url", type="string", nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Naissance\ApplicationBundle\Entity\Wishlist", inversedBy="products")
     * @ORM\JoinColumn(name="wishlist_id", referencedColumnName="id", nullable=false)
     */
    private $wishlist;


    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set currency
     *
     * @param integer $currency
     * @return Product
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return integer 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set pageUrl
     *
     * @param string $pageUrl
     * @return Product
     */
    public function setPageUrl($pageUrl)
    {
        $this->pageUrl = $pageUrl;

        return $this;
    }

    /**
     * Get pageUrl
     *
     * @return string 
     */
    public function getPageUrl()
    {
        return $this->pageUrl;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Product
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Product
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set wishlist
     *
     * @param \Naissance\ApplicationBundle\Entity\Wishlist $wishlist
     * @return Product
     */
    public function setWishlist(\Naissance\ApplicationBundle\Entity\Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;

        return $this;
    }

    /**
     * Get wishlist
     *
     * @return \Naissance\ApplicationBundle\Entity\Wishlist 
     */
    public function getWishlist()
    {
        return $this->wishlist;
    }
}
