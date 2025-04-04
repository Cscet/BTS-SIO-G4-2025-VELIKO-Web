<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

//    /**
//     * @return Reservation[] Returns an array of Reservation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reservation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function countReservationsByUserId(int $userId): int
    {
        return $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->where('r.id_user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getReservationByIdUser(int $id_user): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id_user = :id_user')
            ->setParameter('id_user', $id_user)
            ->getQuery()
            ->getResult();

    }

    public function get5ReservationByIdUser(int $id_user): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id_user = :id_user')
            ->setParameter('id_user', $id_user)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

    }
}
