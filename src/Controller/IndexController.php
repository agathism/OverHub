<?php

namespace App\Controller;

use App\Mail\NewsletterSubscribedConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function home(): Response
    {
        return $this->render('index/home.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($contact);
            $em->flush();
            $email = (new Email())
            ->from('admin@overhub.com')
            ->to($contact->getEmail())
            ->subject('Welcome!')
            ->text('Your email ' . $contact->getEmail() . ' has been successfully registered for the newsletter.')
            ->html('<p>Your Email' . $contact->getEmail() . ' has been successfully registered for the newsletter.</p>');
            $this->addFlash('success', 'You have successfully sent your mail.');
        }
        return $this->render('index/contact.html.twig', [
        'contactForm' => $form 
    ]);
    }

    #[Route('/newsletter', name: 'app_newsletter')]
    public function newsletter(Request $request, EntityManagerInterface $em, NewsletterSubscribedConfirmation $confirmationService): Response 
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($newsletter);
            $em->flush();
            $confirmationService->sendEmail($newsletter);
            $this->addFlash('success', 'Your subscription has been taken into account, you will receive a mail of confirmation');
        }
        return $this->render('newsletter/subscribe.html.twig', [
            'newsletterForm' => $form
        ]);
    }
}
