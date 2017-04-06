<?php

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 05/04/2017
 * Time: 15:54
 */

namespace Piface\AppBundle\EventListener;

use Piface\AppBundle\Services\CensorProcessor;

class CensorListener
{
    protected $processor;

    public function __construct(CensorProcessor $processor)
    {
        $this->processor = $processor;
    }

    public function processCensor(CensorEvent $event)
    {
        $message = $this->processor->censorMessage($event->getMessage());

        $event->setMessage($message);
    }
}
