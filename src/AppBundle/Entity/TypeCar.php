<?php

namespace AppBundle\Entity;

use AppBundle\EntityTraits\BrMoTyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Type de voiture
 *
 * @ORM\Table(name="type_car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeCarRepository")
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class TypeCar
{
    use BrMoTyTrait;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Brand", mappedBy="typeCar")
     */
    private $brands;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->brands = new ArrayCollection();
    }

    /**
     * Add brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return TypeCar
     */
    public function addBrand(Brand $brand)
    {
        $this->brands[] = $brand;

        return $this;
    }

    /**
     * Remove brand
     *
     * @param \AppBundle\Entity\Brand $brand
     */
    public function removeBrand(Brand $brand)
    {
        $this->brands->removeElement($brand);
    }

    /**
     * Get brands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrands()
    {
        return $this->brands;
    }
}
