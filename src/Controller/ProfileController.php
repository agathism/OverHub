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
    public function profile(Request $request, EntityManagerInterface $em): Response
    {
        
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Profil mis à jour avec succès');
            
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'profileForm' => $form->createView(),
        ]);
    }
}
