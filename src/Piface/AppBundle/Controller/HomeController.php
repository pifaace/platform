<?php

namespace Piface\AppBundle\Controller;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 19/02/2017
 * Time: 20:00
 */
class HomeController extends BaseController
{
    public function indexAction()
    {
        return $this->render('PifaceAppBundle:Home:index.html.twig');
    }
}
