<?php

namespace Piface\AppBundle\Form\Handler;

use Doctrine\ORM\EntityManager;
use Piface\AppBundle\Entity\Advert;
use Piface\UserBundle\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 15/03/2017
 * Time: 15:26
 */
class AdvertHandler
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
     * @var User
     */
    protected $user;

    /**
     * @var Advert
     */
    protected $advert;

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

    /**
     * @param User $user
     * on lie le user a l'annonce
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Advert $advert
     * On ajoute egalement l'utilisateur comme auteur
     */
    public function setAdvert(Advert $advert)
    {
        $this->advert = $advert;
    }

    public function process()
    {
        if ('POST' == $this->request->getMethod()) {
            $this->form->handleRequest($this->request);

            if ($this->form->isValid()) {
                $this->advert = $this->form->getData();
                $this->advert->setAuthor($this->user->getName());
                $this->user->addAdvert($this->advert);
                $this->onSuccess($this->advert);
            }
            return true;
        }
        return false;
    }

    public function onSuccess(Advert $advert)
    {
        $this->manager->persist($advert);
        $this->manager->flush();
        return true;
    }
}
