<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TypeCar;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Télécharge la liste des types de voitures.
 *
 * Class LoadTypeCar
 * @package AppBundle\DataFixtures\ORM
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class LoadTypeCar extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Permet d'enregistrer les types de voiture.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $titles = ['Allemandes', 'Françaises'];
        foreach ($titles as $title) {
            $typeCar = (new TypeCar())->setTitle($title);
            $manager->persist($typeCar);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}