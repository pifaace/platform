<?php
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 11/02/2017
 * Time: 18:28
 */
class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Home:home.html.twig');
    }

}