<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HeroesController extends AbstractController
{
    #[Route('/heroes', name: 'app_heroes')]
    public function index(): Response
    {
        return $this->render('heroes/index.html.twig', [
            'controller_name' => 'HeroesController',
        ]);
    }
}
