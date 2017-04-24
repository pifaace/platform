<?php

namespace Piface\AppBundle\Security;

use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Manager\AdvertManager;
use Piface\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 04/04/2017
 * Time: 16:00
 */
class ActionAdvertVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    const VIEW = 'view';

    /**
     * @var AdvertManager
     */
    protected $advertManager;

    protected $decisionManager;

    public function __construct(AdvertManager $advertManager, AccessDecisionManagerInterface $decisionManager)
    {
        $this->advertManager = $advertManager;
        $this->decisionManager = $decisionManager;
    }

    public function supports($attribute, $object)
    {
        if (!in_array($attribute, array(self::EDIT, self::DELETE, self::VIEW))) {
            return false;
        }

        if (!$object instanceof Advert) {
            return false;
        }

        return true;
    }

    public function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $advert = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($advert, $user);
            case self::DELETE:
                return $this->canDelete($advert, $user);
            case self::VIEW:
                return $this->canView($advert);
        }

        throw new \LogicException('This code shouldnt be reached !');
    }

    private function canEdit(Advert $advert, User $user)
    {
        if (null == $advert) {
            return false;
        }

        $offCharter = $this->advertManager->getOffCharter($advert->getId());

        if (true == $offCharter) {
            return false;
        }

        $matchAdvert = $this->advertManager->isAuthorized($advert->getId());

        if ($matchAdvert['id'] != $user->getId()) {
            return false;
        }

        return true;
    }

    private function canDelete(Advert $advert, User $user)
    {
        if (null == $advert) {
            return false;
        }

        $offCharter = $this->advertManager->getOffCharter($advert->getId());

        if (true == $offCharter) {
            return false;
        }

        $matchAdvert = $this->advertManager->isAuthorized($advert->getId());

        if ($matchAdvert['id'] != $user->getId()) {
            return false;
        }

        return true;
    }

    private function canView(Advert $advert)
    {
        if (null == $advert) {
            return false;
        }

        $offCharter = $this->advertManager->getOffCharter($advert->getId());

        if (true == $offCharter) {
            return false;
        }

        return true;

    }
}
