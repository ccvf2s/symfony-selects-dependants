<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Model;
use AppBundle\Entity\TypeCar;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\TypeCarRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

/**
 * Class SelectsSubscriber
 * @package AppBundle\EventSubscriber
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class SelectsSubscriber implements EventSubscriberInterface
{
    /**
     * @var TypeCarRepository
     */
    protected $carRepository;

    /**
     * @var BrandRepository
     */
    protected $brandRepository;

    /**
     * SelectsSubscriber constructor.
     *
     * Initialisation de nos dépendances pour le subscriber
     *
     * @param TypeCarRepository $carRepository Repository TypeCar
     * @param BrandRepository $brandRepository Repository Brand
     */
    public function __construct(
        TypeCarRepository $carRepository,
        BrandRepository $brandRepository
    )
    {
        $this->carRepository = $carRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * On associe les évènements à des fonctions bien précises
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        ];
    }


    /**
     * Cette fonction est lancée lorsque l'évènement PRE_SET_DATA est "attrapé"
     *
     * Elle permet ici de créer les autres selects dépendants dont
     * le second dépend du choix du premier
     *
     * @param FormEvent $event Evenement courant
     */
    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $typeCar = $form->get('type')->getData();

        $this->createChildForm($form, $typeCar);
    }


    /**
     * Cette fonction est lancée lorsque l'évènement PRE_SUBMIT est "attrapé"
     *
     * Cette fonction est lancée lorsqu'on simule un submit près à être enregistré.
     *
     * @param FormEvent $event Evenement courant
     */
    public function onPreSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        $typeCar = null;
        $brand = null;

        if (isset($data['type']) && !empty($data['type'])) {
            $typeCar = $this->carRepository->findOneById(intval($data['type']));
        }

        if (isset($data['brand']) && !empty($data['brand'])) {
            $brand = $this->brandRepository->findOneById(intval($data['brand']));
            $typeCar = $brand->getTypeCar();
        }

        $this->createChildForm($form, $typeCar, $brand);
    }


    /**
     * Permet de créer des champs dépendants
     *
     * @param FormInterface $form   Formulaire courant
     * @param TypeCar|null $typeCar Type de voiture
     * @param Brand|null $brand Marque de la voiture
     */
    protected function createChildForm(
        FormInterface $form,
        TypeCar $typeCar = null,
        Brand $brand = null
    )
    {
        $brandData = is_null($typeCar) ? [] : $typeCar->getBrands();
        $modelData = is_null($brand) ? [] : $brand->getModels();

        $form->add(
            'brand',
            EntityType::class,
            [
                'placeholder' => '--- Choisissez une marque ---',
                'label' => 'Marque de la voiture',
                'class' => 'AppBundle\Entity\Brand',
                'choices' => $brandData,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control']
            ]
        );

        $form->add(
            'model',
            EntityType::class,
            [
                'placeholder' => '--- Choisissez un modèle ---',
                'label' => 'Modèle de la voiture',
                'class' => 'AppBundle\Entity\Model',
                'choices' => $modelData,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control']
            ]
        );
    }
}