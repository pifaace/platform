<?php

namespace Piface\AppBundle\Controller;

use Piface\AppBundle\Controller\BaseController;
use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 06/03/2017
 * Time: 16:34
 */
class UserAdvertController extends BaseController
{
    public function myAdvertListAction()
    {
        $advertManager = $this->get('app.advert.manager');
        $adverts = $advertManager->getMyListAdvert($this->getUser()->getId());

        return $this->render('PifaceAppBundle:Advert/User:myListAdvert.html.twig', array(
            'adverts' => $adverts
        ));
    }

    public function myAdvertShowAction($id)
    {
        $advertManager = $this->get('app.advert.manager');
        $advert = $advertManager->getRepository()->find($id);
        $userAdvertId = [];

        if (null == $advert) {
            throw $this->createNotFoundException('L\'annonce ' . $id . ' n\'existe pas');
        }

        $advertList = $this->getUser()->getAdverts();

        foreach ($advertList as $advertId) {
            $userAdvertId[] = $advertId->getId();
        }
        $match = in_array($id, $userAdvertId);

        if ($match == false) {
            throw $this->createNotFoundException('Cette annonce n\'existe pas');
        }

        return $this->render('PifaceAppBundle:Advert/User:myAdvertShow.html.twig', array(
            'advert' => $advert
        ));
    }

    public function addAdvertAction(Request $request)
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
}
