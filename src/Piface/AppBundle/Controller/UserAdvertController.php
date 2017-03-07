<?php

namespace Piface\AppBundle\Controller;

use Piface\AppBundle\Controller\BaseController;

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

        if (null == $advert) {
            throw $this->createNotFoundException('L\'annonce ' .$id. ' n\'existe pas');
        }


        return $this->render('PifaceAppBundle:Advert/User:myAdvertShow.html.twig', array(
            'advert' => $advert
        ));
    }
}
