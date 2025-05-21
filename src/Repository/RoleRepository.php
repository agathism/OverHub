<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Role>
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }
    public function findTankRole(int $role_id): ?Role
    {
        return $this->createQueryBuilder('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findDpsRole(int $role_id): ?Role
    {
        return $this->createQueryBuilder('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findSupportRole(int $role_id): ?Role
    {
        return $this->createQueryBuilder('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getOneOrNullResult();
    }
//    /**
//     * @return Role[] Returns an array of Role objects
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

//    public function findOneBySomeField($value): ?Role
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
