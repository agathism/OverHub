<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Character>
 */
class CharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    public function findAllWithRole(int $role_id): array
    {
        return $this->createQueryBuilder('c') // L'alias à mettre est la table de départ
            ->join('c.role', 'r')
            // je mettrais en where le numéro de 'lid du role qui correspond
            ->addSelect('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getResult();
    }

    // return $this->render('heroes/tank.html.twig', [
    //     'characters' => $characters,
    //     'selectedRoleId' => $role_id,
    // ]);
    // }

    //    /**
//     * @return Character[] Returns an array of Character objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    //    public function findOneBySomeField($value): ?Character
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
