<?php

namespace Piface\AppBundle\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends EntityRepository
{
    public function countAdvert($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->select('COUNT(a)')
            ->where('a.user = :user')
            ->setParameter(':user', $id);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getListAdvert($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.user = :user')
            ->setParameter(':user', $id);

        return $qb->getQuery()->getResult();
    }

    public function findByKeyWord($keyWord)
    {
        $q = $this->createQueryBuilder('w');

        $q
            ->where('w.title LIKE :keyword')
            ->setParameter(':keyword', '%' . $keyWord . '%');

        return $q->getQuery()->getResult();
    }

    public function findByOptions($category, $keyWord)
    {
        $q = $this->createQueryBuilder('o');

        $q
            ->where('o.category = :category')
            ->setParameter(':category', $category)
            ->andWhere('o.title LIKE :keyword')
            ->setParameter(':keyword', '%' . $keyWord . '%');

        return $q->getQuery()->getResult();
    }

    public function isAuthorized($id)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->leftJoin('a.user', 'user')
            ->select('user.id')
            ->where('a.id = :id')
            ->setParameter(':id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

}
