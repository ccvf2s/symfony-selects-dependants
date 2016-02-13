<?php

namespace AppBundle\Entity;

use AppBundle\EntityTraits\BrMoTyTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Marque de la voiture
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrandRepository")
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class Brand
{
    use BrMoTyTrait;

    /**
     * @var TypeCar
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeCar", inversedBy="brands")
     */
    private $typeCar;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Model", mappedBy="brand")
     */
    private $models;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    /**
     * @return TypeCar
     */
    public function getTypeCar()
    {
        return $this->typeCar;
    }

    /**
     * @param TypeCar $typeCar
     * @return Brand
     */
    public function setTypeCar(TypeCar $typeCar)
    {
        $this->typeCar = $typeCar;

        return $this;
    }

    /**
     * Add model
     *
     * @param \AppBundle\Entity\Model $model
     *
     * @return Brand
     */
    public function addModel(Model $model)
    {
        $this->models[] = $model;

        return $this;
    }

    /**
     * Remove model
     *
     * @param \AppBundle\Entity\Model $model
     */
    public function removeModel(Model $model)
    {
        $this->models->removeElement($model);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModels()
    {
        return $this->models;
    }
}
