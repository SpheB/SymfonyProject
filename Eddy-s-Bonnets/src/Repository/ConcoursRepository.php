<?php

namespace App\Repository;

use App\Entity\Concours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Concours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concours[]    findAll()
 * @method Concours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcoursRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Concours::class);
    }

    // /**
    //  * @return Concours[] Returns an array of Concours objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('c')
      ->andWhere('c.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('c.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Concours
      {
      return $this->createQueryBuilder('c')
      ->andWhere('c.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */

    public function findOneByDate() {
        return $this->createQueryBuilder('c')
                        ->andWhere('c.date_debut <= CURRENT_DATE() AND c.date_fin >= CURRENT_DATE()')
                        ->getQuery()
                        ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Concours[] Returns an array of Concours objects
    //  */

    public function findByConcoursEnCours () {
        return $this->createQueryBuilder('c')
                        ->andWhere('c.date_fin < CURRENT_DATE() AND c.gagnant is NULL')
                        ->getQuery()
                        ->getResult()
        ;
    }

}
