<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/03/2017
 * Time: 18:04
 */

namespace Piface\AppBundle\Controller;


use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends BaseController
{
    public function showAction()
    {

    }

    public function listAction()
    {
        return $this->render('PifaceAppBundle:Advert:listAdvert.html.twig');
    }

    public function editAction($id)
    {

    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = new Advert;
        $form = $this->createForm(new AdvertType(), $advert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $advert->setAuthor($user->getName());
            $user->addAdvert($advert);

            $em->persist($advert);

            $em->flush();

            return $this->redirectToRoute('piface_app_home');
        }

        return $this->render('PifaceAppBundle:Advert:addAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction()
    {

    }
}
