<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 05/04/2017
 * Time: 15:57
 */

namespace Piface\AppBundle\EventListener;


use Piface\UserBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class CensorEvent extends Event
{
    protected $user;

    protected $message;

    public function __construct($message, User $user)
    {
        $this->user = $user;
        $this->message= $message;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


}
