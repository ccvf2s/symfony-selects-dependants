<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Brand;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Permet de télécharger la liste des marques de voitures pour les tests
 *
 * Class LoadBrand
 * @package AppBundle\DataFixtures\ORM
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class LoadBrand extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * Permet d'enregistrer les types de voiture.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $frenchs = ['Peugeot', 'Renault', 'Citroen', 'DS', 'Bugatti'];
        $germans = ['Audi', 'BMW', 'Mercedes', 'VW', 'Opel'];

        $this->registerBrands('Françaises', $frenchs);
        $this->registerBrands('Allemandes', $germans);
        $this->manager->flush();
    }


    /**
     * Permet d'enregistrer les marques de voitures associées à un type
     *
     * @param string $type
     * @param array $titles
     */
    public function registerBrands($type, $titles)
    {
        $typeCar = $this->manager
            ->getRepository('AppBundle:TypeCar')
            ->findOneByTitle($type);
        foreach ($titles as $title) {
            $brand = (new Brand())
                ->setTitle($title)
                ->setTypeCar($typeCar);
            $this->manager->persist($brand);
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}