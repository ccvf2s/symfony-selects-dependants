<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\SelectsDependantsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 *
 * Controller de base pour illustrer notre test
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * Index qui nous permet d'afficher la page
     *
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render(
            'default/index.html.twig'
        );
    }

    /**
     * Renvoie le formulaire avec les bonnes données
     *
     * @Route("/homeform", name="homeform")
     * @Method({"GET", "POST"})
     *
     * @param Request $request Requête courante
     * @return Response
     */
    public function formAction(Request $request)
    {
        $form = $this->createForm(
            SelectsDependantsType::class,
            [],
            [
                'attr' => [
                    'novalidate' => 'novalidate',
                    'action' => $this->generateUrl('homeform')
                ]
            ]
        );

        $form->handleRequest($request);

        if ($form->get('submit')->isClicked()) {
            // Ici vous pouvez effectuer vos tests après clic sur le submit.
        }

        return $this->render(
            'default/form.html.twig',
            ['form' => $form->createView()]
        );
    }
}
