<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProfileType;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('profile/index.html.twig');
    }
}
