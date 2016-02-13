<?php

namespace AppBundle\EntityTraits;

/**
 * Class BrMoTyTrait
 * @package AppBundle\EntityTraits
 *
 * Trait commun aux entités Brand, Model et TypeCar
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
trait BrMoTyTrait
{
    /**
     * Identifiant unique des entités
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Titre d'un type, d'une marque ou d'un modèle de voiture
     *
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * Retourne le titre
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Met à jour le titre de l'entité
     *
     * @param string $title  Titre à mettre à jour
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
