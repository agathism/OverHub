<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

final class HeroesController extends AbstractController
{
    #[Route('/heroes', name: 'app_heroes')]
    public function heroes(CharacterRepository $characterRepository): Response
    {
        $characters = $characterRepository->findAll();
        return $this->render('heroes/heroes.html.twig', [
            'characters' => $characters
        ]);
    }

    #[Route('/heroes/{id}', name: 'app_hero')]
    public function hero(CharacterRepository $characterRepository, int $id): Response
    {
        $character = $characterRepository->find($id);
        if (!$character) {
            throw $this->createNotFoundException('The character does not exist');
        }
        return $this->render('heroes/hero.html.twig', ['character' => $character]);
    }

    // #[Route('/character/{role_id?}', name: 'tank_heroes')]
    // public function index(EntityManagerInterface $em, CharacterRepository $characterRepository,  ?int $role_id = null): Response
    // {

    // if ($role_id) {
    //     $characters = $repo->createQueryBuilder('p')
    //         ->join('p.role', 'r')
    //         ->where('r.id = :roleId')
    //         ->setParameter('roleId', $role_id)
    //         ->getQuery()
    //         ->getResult();
    // } else {
    //     $characters = $repo->findAll();
    // }

    // return $this->render('heroes/tank.html.twig', [
    //     'characters' => $characters,
    //     'selectedRoleId' => $role_id,
    // ]);
    // }
}