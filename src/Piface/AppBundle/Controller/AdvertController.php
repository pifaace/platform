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

        if (false == $this->isGranted('view', $advert)) {
            throw $this->createNotFoundException("Cette annonce n'existe pas");
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
            $adverts = $advertManager->getRepository()->getAdverts();
        }

        $advertsForwardArray = $advertManager->getRepository()->findBy(array(
            'forward' => true,
            'offCharter' => false
        ));

        $advertsForward = $this->randomAdvertForward($advertsForwardArray);

        return $this->render('PifaceAppBundle:Advert:listAdvert.html.twig', array(
            'adverts' => $adverts,
            'advertsForward' => $advertsForward,
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

    private function randomAdvertForward($advertForwardArray)
    {
        $advertRand = array();
        if (count($advertForwardArray) > 3) {
            $rand_advert = array_rand($advertForwardArray, 3);

            for ($i = 0; $i < 3; $i++) {
                $advertRand[] = $advertForwardArray[$rand_advert[$i]];
            }

            return $advertRand;
        }

        return $advertForwardArray;
    }
}
