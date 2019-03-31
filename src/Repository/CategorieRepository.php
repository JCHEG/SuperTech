<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    /**
     * return les catégories de niveau 1 (ces catégories contiennent des sous-catégories qui contiennent de sous-sous-catégories)
     * */
    public function findCatFirstLevel() : array
    {
        $query = $this->_em->createQuery('SELECT c FROM App\Entity\Categorie c WHERE c.id = c.categorie');
        $results = $query->getResult();
//         $qb = $this->createQueryBuilder('a');

//         $qb
//         ->where('a.categorie_id = :cat')
//         ->setParameter('cat', null);

//         return $qb
//         ->getQuery()
//         ->getResult()
//         ;
        return $results;
    }
    // /**
    //  * @return Categorie[] Returns an array of Categorie objects
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
    public function findOneBySomeField($value): ?Categorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
