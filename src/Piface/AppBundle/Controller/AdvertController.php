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

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if (false == $this->checkUrl($request)) {
                return $this->redirectToRoute('piface_app_home');
            }

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


    private function checkUrl(Request $request)
    {
        $category_array = ['', '1', '2', '3', '4', '5', '6', '7'];

        try {
            $urlPara = $request->query->get('filter');
            $urlPara['kw'];

            if (!in_array($urlPara['category'], $category_array)) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
