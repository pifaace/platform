<?php

namespace Piface\AppBundle\Controller;

use Piface\AppBundle\Controller\BaseController;
use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Form\AdvertType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $userId = $this->getUser()->getId();

        if (null == $advert) {
            throw $this->createNotFoundException('L\'annonce ' . $id . ' n\'existe pas');
        }
        $matchAdvert = $advertManager->isAuthorized($id);

        if ($matchAdvert['id'] != $userId) {
            throw new NotFoundHttpException('Cette annonce n\'existe ');
        }

        return $this->render('PifaceAppBundle:Advert/User:showAdvert.html.twig', array(
            'advert' => $advert
        ));
    }

    public function addAction()
    {
        $advert = new Advert;
        $form = $this->createForm(new AdvertType(), $advert);

        $advertHandler = $this->get('advert.handler.form');
        $advertHandler->setUser($this->getUser());
        $advertHandler->setAdvert($advert);
        $advertHandler->setForm($form);

        if ($advertHandler->process()) {
            return $this->redirectToRoute('piface_app_home');
        }

        return $this->render('PifaceAppBundle:Advert/User:addAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
