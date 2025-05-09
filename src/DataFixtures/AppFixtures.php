<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Ability;
use App\Entity\Character;
use App\Entity\Lore;
use App\Entity\Roles;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $regularUser = new User();
        $regularUser
            ->setEmail('geodesie@bob.com')
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'));
        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setEmail('admin@overhub.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'heroes'));
          
        $manager->persist($adminUser);

        $manager->flush();
    }
}
