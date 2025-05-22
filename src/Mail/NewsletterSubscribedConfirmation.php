<?php

namespace App\Mail;

use App\Entity\Newsletter;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NewsletterSubscribedConfirmation
{
    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {
    }

    public function sendEmail(Newsletter $newsletter): void
    {
        $email = (new Email())
        ->from($this->adminEmail)
        ->to($newsletter->getEmail())
        ->subject('Welcome !')
        ->text('Your mail ' . $newsletter->getEmail() . ' has been registered in our liste of subscribers.')
        ->html('<p>Your mail ' . $newsletter->getEmail() . ' has been registered in our liste of subscribers.</p>');

        $this->mailer->send($email);
    }
}