<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\Role;
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
    
    public function findTanks (int $role_id): array
    {
        return $this->createQueryBuilder('c')
            ->join('c.role', 'r')
            ->addSelect('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getResult();
    }
    public function findSupports (int $role_id): array
    {
        return $this->createQueryBuilder('c')
            ->join('c.role', 'r')
            ->addSelect('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getResult();
    }
    public function findDamage (int $role_id): array
    {
        return $this->createQueryBuilder('c')
            ->join('c.role', 'r')
            ->addSelect('r')
            ->where('r.id = :roleId')
            ->setParameter('roleId', $role_id)
            ->getQuery()
            ->getResult();
    }
}
