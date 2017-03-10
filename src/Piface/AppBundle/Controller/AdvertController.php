<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/03/2017
 * Time: 18:04
 */

namespace Piface\AppBundle\Controller;


class AdvertController extends BaseController
{
    public function showAction($id)
    {
        $advertManager = $this->get('app.advert.manager');
        $advert = $advertManager->getRepository()->find($id);

        if (null == $advert) {
            throw $this->createNotFoundException('L\'annonce ' . $id . ' n\'existe pas');
        }

        return $this->render('PifaceAppBundle:Advert:showAdvert.html.twig', array(
            'advert' => $advert
        ));
    }

    public function listAction()
    {
        $advertManager = $this->get('app.advert.manager');
        $adverts = $advertManager->getRepository()->findAll();
        return $this->render('PifaceAppBundle:Advert:listAdvert.html.twig', array(
            'adverts' => $adverts
        ));
    }


    public function deleteAction()
    {

    }
}
