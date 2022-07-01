<?php

namespace App\Repository;

use App\Entity\LinkedAccounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LinkedAccounts>
 *
 * @method LinkedAccounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkedAccounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkedAccounts[]    findAll()
 * @method LinkedAccounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkedAccountsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkedAccounts::class);
    }

    public function add(LinkedAccounts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LinkedAccounts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LinkedAccounts[] Returns an array of LinkedAccounts objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LinkedAccounts
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
