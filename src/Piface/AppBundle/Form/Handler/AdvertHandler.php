<?php

namespace Piface\AppBundle\Form\Handler;

use Doctrine\ORM\EntityManager;
use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\EventListener\CensorEvent;
use Piface\UserBundle\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

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

    /**
     * @var TraceableEventDispatcher
     */
    protected $eventDispatcherService;


    public function __construct(Request $request, EntityManager $manager, TraceableEventDispatcher $eventDispatcherService)
    {
        $this->request = $request;
        $this->manager = $manager;
        $this->eventDispatcherService = $eventDispatcherService;
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

    public function process($mode)
    {
        if ('POST' == $this->request->getMethod()) {
            $this->form->handleRequest($this->request);

            if ($this->form->isSubmitted() && $this->form->isValid()) {

                $this->advert = $this->form->getData();

                $warning = $this->controleAdvertContent($this->user, $this->advert->getContent());

                $event = new CensorEvent($this->advert->getContent(), $this->user);
                $this->eventDispatcherService->dispatch('app.censor.message', $event);
                $this->advert->setContent($event->getMessage());

                if ('create' == $mode) {
                    $this->advert->setAuthor($this->user->getName());
                    $this->advert->setUser($this->user);
                }
                $this->onSuccess($this->advert);

                if (true == $warning) {
                    return "warning";
                } else {
                    return true;
                }

            }
        }
        return false;
    }

    public function onSuccess(Advert $advert)
    {
        $this->manager->persist($advert);
        $this->manager->flush();
        return true;
    }

    public function delete(Advert $advert)
    {
        if ('POST' == $this->request->getMethod()) {
            $this->form->handleRequest($this->request);
            if ($this->form->isSubmitted() && $this->form->isValid()) {
                try {
                    $this->manager->remove($advert);
                    $this->manager->flush();

                    return true;
                } catch (\Exception $e) {
                    error_log($e->getMessage());
                }
            }
        }
        return false;
    }

    public function controleAdvertContent(User $user, $content)
    {
        $censorWords = array('putain', 'connard', 'encule', 'pd', 'salaud');

        foreach ($censorWords as $censorWord) {
            if (preg_match('#' . $censorWord . '#', $content)) {
                $user->setWarning($user->getWarning() + 1);
                $this->advert->setOffCharter(true);

                if ($user->getWarning() >= 3) {
                    $user->setEnabled(0);
                }

                return true;
            }
        }
        return false;
    }

}
