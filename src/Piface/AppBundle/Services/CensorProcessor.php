<?php

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 05/04/2017
 * Time: 16:03
 */

namespace Piface\AppBundle\Services;

class CensorProcessor
{
    public function censorMessage($message)
    {
        $censorWord = array('putain', 'connard');

        $message = str_replace($censorWord, '******', $message);

        return $message;
    }
}
