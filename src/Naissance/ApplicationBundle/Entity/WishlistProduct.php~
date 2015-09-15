<?php

namespace Naissance\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * WishlistProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Naissance\ApplicationBundle\Repository\WishlistProductRepository")
 */
class WishlistProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\Column(name="level", type="string", length=255)
    */
    private $level;


    /**
    * @ORM\ManyToOne(targetEntity="Naissance\ApplicationBundle\Entity\Wishlist")
    * @ORM\JoinColumn(nullable=false)
    */
    private $wishlist;


    /**
    * @ORM\ManyToOne(targetEntity="Naissance\ApplicationBundle\Entity\Product")
    * @ORM\JoinColumn(nullable=false)
    */
    private $product;



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
     * Set level
     *
     * @param string $level
     * @return WishlistProduct
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set wishlist
     *
     * @param \Naissance\ApplicationBundle\Entity\Wishlist $wishlist
     * @return WishlistProduct
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

    /**
     * Set product
     *
     * @param \Naissance\ApplicationBundle\Entity\Product $product
     * @return WishlistProduct
     */
    public function setProduct(\Naissance\ApplicationBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Naissance\ApplicationBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
