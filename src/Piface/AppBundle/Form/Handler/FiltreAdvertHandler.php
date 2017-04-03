<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/04/2017
 * Time: 14:19
 */

namespace Piface\AppBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use Piface\AppBundle\Entity\Advert;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FiltreAdvertHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var EntityManager
     */
    protected $manager;

    public function __construct(Request $request, EntityManager $manager)
    {
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * @param FormInterface $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    public function process()
    {
            $this->form->handleRequest($this->request);

            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $data = $this->form->getData();

                if (null == $data['category']) {
                    $adverts = $this->manager->getRepository('PifaceAppBundle:Advert')->findAll();
                } else {
                    $adverts = $this->manager->getRepository('PifaceAppBundle:Advert')->findBy(
                        array('category' => $data)
                    );
                }

                return $adverts;
            }

            return false;
    }


}
