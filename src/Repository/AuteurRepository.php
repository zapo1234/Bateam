<?php

namespace App\Repository;

use App\Entity\Auteur;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
    //  */
    
    public function findLimitAuteurs()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // recupere les auteurs ainsi que les products associé 
     public function auteurProducts(int $id) 

    {
        return $this->createQueryBuilder('a')
            ->select('a,p')
            ->join('a.prodcuts','p')
            ->where('a.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getSingleResult();
        ;
   }
    

    /*
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
