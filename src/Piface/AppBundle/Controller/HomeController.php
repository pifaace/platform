<?php

namespace Piface\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 19/02/2017
 * Time: 20:00
 */
class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('PifaceAppBundle:Home:index.html.twig');
    }
}
