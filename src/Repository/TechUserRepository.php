<?php

namespace App\Repository;

use App\Entity\TechUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TechUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechUser[]    findAll()
 * @method TechUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TechUser::class);
    }

    // /**
    //  * @return TechUser[] Returns an array of TechUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TechUser
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
