<?php

namespace App\Repository;

use App\Entity\PanierQte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PanierQte>
 *
 * @method PanierQte|null find($id, $lockMode = null, $lockVersion = null)
 * @method PanierQte|null findOneBy(array $criteria, array $orderBy = null)
 * @method PanierQte[]    findAll()
 * @method PanierQte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierQteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PanierQte::class);
    }

//    /**
//     * @return PanierQte[] Returns an array of PanierQte objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PanierQte
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
