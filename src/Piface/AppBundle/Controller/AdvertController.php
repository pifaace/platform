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
    public function listAction()
    {
        return $this->render('PifaceAppBundle:Advert:index.html.twig');
    }

    public function editAction($id)
    {

    }

    public function addAction()
    {
        return $this->render('PifaceAppBundle:Advert:addAdvert.html.twig');
    }

    public function deleteAction()
    {

    }
}
