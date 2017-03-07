<?php

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 07/03/2017
 * Time: 11:10
 */

namespace Piface\AppBundle\Manager\Base;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Acl\Exception\Exception;

abstract class BaseManager
{
    protected $em;

    /**
     * @param EntityManager $em
     * @internal param EntityManager $oEm
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Get the repository of the current entity
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->getEntityName());
    }

    /**
     * Get the entity name
     *
     * @return string
     */
    abstract public function getEntityName();

    /**
     * Get the meta data of the current entity
     *
     * @return \Doctrine\ORM\Mapping\ClassMetadata
     */
    public function getClassMetaData()
    {
        return $this->em->getClassMetadata($this->getEntityName());
    }

    /**
     * Get the reference of the current entity
     *
     * @param  mixed $id
     *
     * @return object
     */
    public function getReference($id)
    {
        return $this->em->getReference($this->getEntityName(), $id);
    }

    /**
     * Find by id
     *
     * @param string $id
     *
     * @return object
     */
    public function find($id)
    {
        return $this->em->find($this->getEntityName(), $id);
    }

    /**
     * Persist and flush shortcuts
     *
     * @param object $entity
     *
     * @return \Api\RestBundle\Manager\Base\BaseManager
     *
     */
    public function persistAndFlush($entity)
    {
        return $this->persist($entity)->flush();
    }

    /**
     * Flush
     *
     * @return \Api\RestBundle\Manager\Base\BaseManager
     *
     */
    public function flush()
    {
        $this->em->flush();

        return $this;
    }

    /**
     * Persist of the given entity
     *
     * @param object $entity
     *
     * @return \Api\RestBundle\Manager\Base\BaseManager
     *
     */
    public function persist($entity)
    {
        $this->em->persist($entity);

        return $this;
    }

    /**
     * Remove the given entity
     *
     * @param $entity
     *
     * @return $this
     *
     */
    public function remove($entity)
    {
        $this->em->remove($entity);

        return $this;
    }
}
