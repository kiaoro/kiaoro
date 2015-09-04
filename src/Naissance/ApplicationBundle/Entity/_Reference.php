<?php

namespace Naissance\ApplicationBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/*
Reference
(name="reference", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"wishlist_id", "product_id"})})
(repositoryClass="Naissance\ApplicationBundle\Repository\ReferenceRepository")
 */

class Reference
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
    * @ORM\Column(name="level", type="string", length=255, nullable=true)
    */
    private $level;

    /**
    * @ORM\ManyToOne(targetEntity="Naissance\ApplicationBundle\Entity\Wishlist", inversedBy="references")
    * @ORM\JoinColumn(nullable=false)
    */
    private $wishlist;


    /**
    * @ORM\ManyToOne(targetEntity="Naissance\ApplicationBundle\Entity\Product", inversedBy="references")
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
     * @return Reference
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
     * @return Reference
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
     * @return Reference
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
