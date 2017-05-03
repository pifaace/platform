<?php

namespace Piface\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends BaseController
{
    public function showAction()
    {
        $advertManager = $this->get('app.advert.manager');
        $countAdvert = $advertManager->countAdvert($this->getUser()->getId());
        $adverts = $advertManager->getMyAdverts($this->getUser()->getId());
        $warning = $this->getUser()->getWarning();


        return $this->render('PifaceAppBundle:Dashboard:show.html.twig', array(
            'countAdvert' => $countAdvert,
            'adverts' => $adverts,
            'warning' => $warning
        ));
    }

}
