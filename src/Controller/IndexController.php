<?php

namespace App\Controller;

use App\Mail\NewsletterSubscribedConfirmation;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;


final class IndexController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function home(): Response
    {
        return $this->render('index/home.html.twig');
    }

    #[Route('/heroes', name: 'app_heroes')]
    public function list(CharacterRepository $characterRepository): Response
    {
        $characters = $characterRepository->findAll();

        return $this->render('index/heroes.html.twig', [
            'characters' => $characters
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //enregistrer le message dans la base de données
            $em->persist($contact);
            $em->flush();

            //envoyer un email de confirmation
            // Construire le message
            $email = (new Email())
            ->from('admin@overhub.fr')
            ->to($contact->getEmail())
            ->subject('Welcome!')
            ->text('Your email ' . $contact->getEmail() . ' has been successfully registered for the newsletter.')
            ->html('<p>Your Email' . $contact->getEmail() . ' has been successfully registered for the newsletter.</p>');

            // // Envoyer le message
            // $mailer->send($email);

            // Ajouter un message flash
            $this->addFlash('success', 'You have successfully sent your mail.');
        }
        return $this->render('index/contact.html.twig', [
        'contactForm' => $form 
    ]);
    }
}
