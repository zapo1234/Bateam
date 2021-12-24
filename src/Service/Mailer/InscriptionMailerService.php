<?php
namespace App\Service\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environement;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class InscriptionMailerService

{

/*
@var MailerInterface

*/
private $mailer;

/*
*@ var contructor of class Mailler
*@ var $mailer
*@var twig
*/

public function __construct(MailerInterface $mailer) {
$this->mailer = $mailer;
}

/** 
*@param string $subject
*@param  string $to expeditor
*@param string $template
*@param array $parameter
*
**/

public function sendEmail(string $to, string $from, string $subject, string $template, array $parameters): void

{
// construire l'envoi de mail
$email = (new TemplatedEmail())
        ->from($from)
        ->to($to)
        ->subject($subject)
        ->htmlTemplate("emails/$template.html.twig")
        ->context($parameters);
        // envoi du mail
        $this->mailer->send($email);

}

}




















