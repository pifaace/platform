<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/03/2017
 * Time: 10:27
 */

namespace Piface\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function isFullyAuthenticated(){
        return $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
    }
}
