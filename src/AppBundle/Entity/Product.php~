<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_available", type="boolean")
     */
    private $isAvailable;

    /**
     * one Product has one image
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Box", inversedBy="products")
     */
    private $box;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, unique=true)
     */
    private $category;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->box = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
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
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     *
     * @return Product
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Product
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
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Product
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add box
     *
     * @param \AppBundle\Entity\Box $box
     *
     * @return Product
     */
    public function addBox(\AppBundle\Entity\Box $box)
    {
        $this->box[] = $box;

        return $this;
    }

    /**
     * Remove box
     *
     * @param \AppBundle\Entity\Box $box
     */
    public function removeBox(\AppBundle\Entity\Box $box)
    {
        $this->box->removeElement($box);
    }

    /**
     * Get box
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * Set box
     *
     * @param \AppBundle\Entity\Box $box
     *
     * @return Product
     */
    public function setBox(\AppBundle\Entity\Box $box = null)
    {
        $this->box = $box;

        return $this;
    }
}
