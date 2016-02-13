<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Model;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Permet de télécharger la liste des modèles de voitures pour les tests
 *
 * Class LoadModel
 * @package AppBundle\DataFixtures\ORM
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class LoadModel extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $data = [
            [
                'key' => 'Peugeot',
                'title' => ['206', '406', '407', '508']
            ],
            [
                'key' => 'Renault',
                'title' => ['Clio 1', 'Clio 2', 'Clio 3', 'Clio 4']
            ],
            [
                'key' => 'Citroen',
                'title' => ['C4', 'C1', 'C3', 'Cactus']
            ],
            [
                'key' => 'DS',
                'title' => ['DS', 'DS3', 'DS4', 'DS5']
            ],
            [
                'key' => 'Bugatti',
                'title' => ['‎Ettore Bugatti', 'Bugatti Veyron 16.4', 'Bugatti Type 35', 'Bugatti Type 251']
            ],
            [
                'key' => 'Audi',
                'title' => ['TT', 'A3', 'A4', 'A5']
            ],
            [
                'key' => 'BMW',
                'title' => ['SERIE 1', 'X1', 'X3', 'X5']
            ],
            [
                'key' => 'Mercedes',
                'title' => ['CLS', 'GLA', 'CLA', 'GLE']
            ],
            [
                'key' => 'VW',
                'title' => ['Golf 1', 'Golf 2', 'Golf 3', 'Golf 4']
            ],
            [
                'key' => 'Opel',
                'title' => ['Astra', 'GTC', 'Corsa', 'CASCADA']
            ],
        ];

        foreach ($data as $d) {
            $this->registerModels($d['key'], $d['titles']);
        }
        $this->manager->flush();
    }


    /**
     * Permet d'enregistrer les modèles associés aux marques
     *
     * @param string $type
     * @param array $titles
     */
    public function registerModels($type, $titles)
    {
        $brand = $this->manager
            ->getRepository('AppBundle:Brand')
            ->findOneByTitle($type);
        foreach ($titles as $title) {
            $model = (new Model())
                ->setTitle($title)
                ->setBrand($brand);
            $this->manager->persist($model);
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}