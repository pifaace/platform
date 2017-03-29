<?php

namespace Piface\AppBundle\Controller;

use Piface\AppBundle\Controller\BaseController;
use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Form\AdvertType;
use Piface\AppBundle\Form\EditAdvertType;
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

        $this->controleAccess($advertManager, $advert, $id);

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

        if ($advertHandler->process('create')) {
            return $this->redirectToRoute('piface_app_my_advert', array('id' => $advert->getId()));
        }

        return $this->render('PifaceAppBundle:Advert/User:addAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id)
    {
        $advertManager = $this->get('app.advert.manager');
        $advert = $advertManager->getRepository()->find($id);

        $this->controleAccess($advertManager, $advert, $id);

        $editForm = $this->createForm(new EditAdvertType(), $advert);

        $advertHandler = $this->get('advert.handler.form');
        $advertHandler->setForm($editForm);

        if ($advertHandler->process('edit')) {
            return $this->redirectToRoute('piface_app_my_advert', array('id' => $advert->getId()));
        }

        return $this->render('PifaceAppBundle:Advert/User:editAdvert.html.twig', array(
            'advert' => $advert,
            'form' => $editForm->createView()
        ));
    }

    public function deleteAction($id)
    {
        $advertManager = $this->get('app.advert.manager');
        $advert = $advertManager->getRepository()->find($id);

        $this->controleAccess($advertManager, $advert, $id);

        $form = $this->createFormBuilder()->getForm();
        $advertHandler = $this->get('advert.handler.form');
        $advertHandler->setForm($form);

        if ($advertHandler->delete($advert)) {
            return $this->redirectToRoute('piface_app_my_advert_list');
        }

        return $this->render('PifaceAppBundle:Advert/User:deleteAdvert.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView()
        ));
    }

    private function controleAccess($advertManager, $advert, $id)
    {
        $userId = $this->getUser()->getId();

        if (null == $advert) {
            throw $this->createNotFoundException('L\'annonce ' . $id . ' n\'existe pas');
        }
        $matchAdvert = $advertManager->isAuthorized($id);

        if ($matchAdvert['id'] != $userId) {
            throw new NotFoundHttpException('Cette annonce n\'existe pas');
        }

    }

}
