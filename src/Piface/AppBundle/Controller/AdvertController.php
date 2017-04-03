<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/03/2017
 * Time: 18:04
 */

namespace Piface\AppBundle\Controller;


use Piface\AppBundle\Form\FiltreAdvertType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function listAction(Request $request)
    {
        $form = $this->createForm(new FiltreAdvertType());

        $advertManager = $this->get('app.advert.manager');

        if ('POST' == $request->getMethod()) {
            $filterAdvertHandler = $this->get('filter.advert.handler.form');
            $filterAdvertHandler->setForm($form);

            $adverts = $filterAdvertHandler->process();
        } else {
            $adverts = $advertManager->getRepository()->findAll();
        }

        return $this->render('PifaceAppBundle:Advert:listAdvert.html.twig', array(
            'adverts' => $adverts,
            'form' => $form->createView()
        ));
    }
}
