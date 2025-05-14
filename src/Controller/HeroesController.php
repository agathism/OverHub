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
    public function heroes(CharacterRepository $characterRepository, RoleRepository $RoleRepository): Response
    {
        $characters = $characterRepository->findAll();
        $roles = $RoleRepository->findAll();
        return $this->render('heroes/heroes.html.twig', [
            'characters' => $characters, 
            'role' => $roles
        ]);
    }

    #[Route('/heroes/{id}', name: 'app_hero')]
    public function hero(CharacterRepository $characterRepository, UltimateRepository $UltimateRepository, StrategyRepository $StrategyRepository, RoleRepository $RoleRepository, int $id): Response
    {
        $character = $characterRepository->find($id);
        if (!$character) {
            throw $this->createNotFoundException('The character does not exist');
        }

        $ultimate = $UltimateRepository->find($id);
        if (!$ultimate) {
            throw $this->createNotFoundException('The ultimate does not exist');
        }

        $strategy = $StrategyRepository->find($id);
        if (!$strategy) {
            throw $this->createNotFoundException('The ultimate does not exist');
        }

        $role = $RoleRepository->find($id);
        if (!$role) {
            throw $this->createNotFoundException('The ultimate does not exist');
        }
        return $this->render('heroes/hero.html.twig', ['character' => $character, 'ultimate' => $ultimate, 'strategy' => $strategy, 'role' => $role]);
    }

}