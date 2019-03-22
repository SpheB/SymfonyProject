<?php

namespace App\Repository;

use App\Entity\FanComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FanComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method FanComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method FanComment[]    findAll()
 * @method FanComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FanCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FanComment::class);
    }

    // /**
    //  * @return FanComment[] Returns an array of FanComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FanComment
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
