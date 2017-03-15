<?php

/**
 * Created by PhpStorm.
 * User: Maxime
 * Date: 14/03/2017
 * Time: 19:03
 */

namespace Piface\AppBundle\Services;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class accessAdvert
{
    public function isAuthorized($id, $advertList)
    {
        $userAdvertId = [];

        foreach ($advertList as $advertId) {
            $userAdvertId[] = $advertId->getId();
        }
        $match = in_array($id, $userAdvertId);

        if ($match == false) {
            throw new NotFoundHttpException('Cette annonce n\'existe pas');
        }
    }
}