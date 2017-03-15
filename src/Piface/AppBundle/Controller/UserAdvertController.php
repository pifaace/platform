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
    public function listAction()
    {
        $advertManager = $this->get('app.advert.manager');
        $adverts = $advertManager->getMyListAdvert($this->getUser()->getId());

        return $this->render('PifaceAppBundle:Advert/User:listAdvert.html.twig', array(
            'adverts' => $adverts
        ));
    }

    public function showAction($id)
    {
        $advertManager = $this->get('app.advert.manager');
        $advert = $advertManager->getRepository()->find($id);
        $advertList = $this->getUser()->getAdverts();

        if (null == $advert) {
            throw $this->createNotFoundException('L\'annonce ' . $id . ' n\'existe pas');
        }

        $accessAdvert = $this->get('platform.access_advert');
        $accessAdvert->isAuthorized($id, $advertList);

        return $this->render('PifaceAppBundle:Advert/User:showAdvert.html.twig', array(
            'advert' => $advert
        ));
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

        return $this->render('PifaceAppBundle:Advert/User:addAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
