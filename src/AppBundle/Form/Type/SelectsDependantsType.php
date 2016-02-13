<?php

namespace AppBundle\Form\Type;

use AppBundle\EventSubscriber\SelectsSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SelectsDependantsType
 * @package AppBundle\Form\Type
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class SelectsDependantsType extends AbstractType
{
    /**
     * @var SelectsSubscriber
     */
    protected $selectsSubscriber;

    /**
     * SelectsDependantsType constructor.
     *
     * Injecte les dépendances au service formulaire
     * @param SelectsSubscriber $subscriber Subscriber qui permet de construire les champs à la volée
     */
    public function __construct(SelectsSubscriber $subscriber)
    {
        $this->selectsSubscriber = $subscriber;
    }

    /**
     * Permet de construire les champs d'un formulaire
     *
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                EntityType::class,
                [
                    'placeholder' => 'Choisissez un type de voiture',
                    'label' => 'Type de voiture',
                    'class' => 'AppBundle\Entity\TypeCar',
                    'choice_label' => 'title',
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Sauvegarder', 'attr' => ['class' => 'btn btn-success']]
            );

        $builder->addEventSubscriber($this->selectsSubscriber);
    }

    /**
     * Configure les options du formulaire
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_selects_dependants';
    }
}