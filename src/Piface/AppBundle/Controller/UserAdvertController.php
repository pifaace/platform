<?php

namespace Piface\AppBundle\Controller;

use Doctrine\ORM\Internal\Hydration\HydrationException;
use Piface\AppBundle\Controller\BaseController;
use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Form\AdvertType;
use Piface\AppBundle\Form\EditAdvertType;
use Piface\AppBundle\Security\ActionAdvertVoter;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        return $this->render('PifaceAppBundle:Advert/User:listAdvertSave.html.twig'
        );
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
            return $this->redirectToRoute('piface_app_advert', array('id' => $advert->getId()));
        }

        return $this->render('PifaceAppBundle:Advert/User:addAdvert.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id)
    {
        $advertManager = $this->get('app.advert.manager');
        $advert = $advertManager->getRepository()->find($id);

        if (false == $this->isGranted('edit', $advert)) {
            throw $this->createNotFoundException("Cette annonce n'existe pas");
        }

        $editForm = $this->createForm(new EditAdvertType(), $advert);

        $advertHandler = $this->get('advert.handler.form');
        $advertHandler->setUser($this->getUser());
        $advertHandler->setForm($editForm);

        if ($advertHandler->process('edit')) {
            return $this->redirectToRoute('piface_app_advert', array('id' => $advert->getId()));
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

        if (false == $this->isGranted('delete', $advert)) {
            throw $this->createNotFoundException("Cette annonce n'existe pas");
        }

        $form = $this->createFormBuilder()->getForm();
        $advertHandler = $this->get('advert.handler.form');
        $advertHandler->setForm($form);

        if ($advertHandler->delete($advert)) {
            return $this->redirectToRoute('piface_app_dashboard');
        }

        return $this->render('PifaceAppBundle:Advert/User:deleteAdvert.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView()
        ));
    }
}
