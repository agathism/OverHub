<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

}