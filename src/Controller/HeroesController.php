<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use App\Repository\RoleRepository;
use App\Repository\StrategyRepository;
use App\Repository\UltimateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HeroesController extends AbstractController
{
    #[Route('/heroes', name: 'app_heroes')]
    public function heroes(CharacterRepository $characterRepository, RoleRepository $roleRepository): Response
    {
        // Je vais afficher les héros par leur rôle
        $tanks = $characterRepository->findTanks(40);
        $damages = $characterRepository->findDamage(41);
        $supports = $characterRepository->findSupports(42);
        $characters = $characterRepository->findAll();
        $roles = $roleRepository->findAll();
        return $this->render('heroes/heroes.html.twig', [
            'characters' => $characters, 
            'role' => $roles,
            'tanks' => $tanks,
            'supports' => $supports,
            'damages' => $damages
        ]);
    }

    #[Route('/heroes/{id}', name: 'app_hero')]
    public function hero(CharacterRepository $characterRepository, UltimateRepository $ultimateRepository, StrategyRepository $strategyRepository, RoleRepository $roleRepository, int $id): Response
    {      
        $character = $characterRepository->find($id);
        if (!$character) {
            throw $this->createNotFoundException('The character does not exist');
        }

        // Assuming $character has a getRole() method to retrieve its role
        // $role = $character->getRole();
        // $character = $characterRepository->findCharacterRole($role);
        // if (!$character) {
        //     throw $this->createNotFoundException('The character does not exist');
        // }

        $ultimate = $ultimateRepository->findCharacterUltimate($character);
        if (!$ultimate) {
            throw $this->createNotFoundException('The ultimate does not exist');
        }

        $strategy = $strategyRepository->findCharacterStrategy($character);
        if (!$strategy) {
            throw $this->createNotFoundException('The strategy does not exist');
        }

        // $role = $roleRepository->find($id);
        // if (!$role) {
        //     throw $this->createNotFoundException('The role does not exist');
        // }
        return $this->render('heroes/hero.html.twig', ['character' => $character, 'ultimate' => $ultimate, 'strategy' => $strategy]);
    }

}