<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendMail()
    {
        $email = (new Email())
            ->from('')
            ->to('')
            ->cc('')
            ->bcc('')
            ->replyTo('')
            ->priority('')
            ->subject('')
            ->text('')
            ->html($this->twig->render('', []))
            ->attachFromPath('')
            ->attach('');

        $email2 = (new TemplatedEmail())
            ->from('')
            ->to(new Address(''))
            ->subject('')
            ->htmlTemplate('emails/email.html.twig')
            ->context([
                'name' => "Toto"
            ]);

        sleep(1);
        try {
            $this->mailer->send($email);
            return true;
        } catch (TransportExceptionInterface $e) {
            return false;
        }
    }
}