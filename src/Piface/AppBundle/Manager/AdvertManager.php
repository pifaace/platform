<?php

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 07/03/2017
 * Time: 11:07
 */

namespace Piface\AppBundle\Manager;

use Piface\AppBundle\Manager\Base\BaseManager;
use Piface\AppBundle\Repository\AdvertRepository;

class AdvertManager extends BaseManager
{
    public function getEntityName()
    {
        return 'PifaceAppBundle:Advert';
    }

    /**
     * @return AdvertRepository
     */
    public function getRepository()
    {
        return parent::getRepository(); // TODO: Change the autogenerated stub
    }

    public function getMyListAdvert($id)
    {
        return $this->getRepository()->getMyListAdvert($id);
    }

    public function isAuthorized($advertId, $advertIdList)
    {
        return $this->getRepository()->isAuthorized($advertId, $advertIdList);
    }
}
