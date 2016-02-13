<?php

namespace AppBundle\Entity;

use AppBundle\EntityTraits\BrMoTyTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Modèle de la voiture
 *
 * @ORM\Table(name="model")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModelRepository")
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class Model
{
    use BrMoTyTrait;

    /**
     * @var TypeCar
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Brand", inversedBy="models")
     */
    private $brand;

    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

