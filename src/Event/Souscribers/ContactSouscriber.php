<?php
namespace App\Event\Soucribers;
use App\Event\ContactEvents;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Mailer\InscriptionMailerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContactSubscriber implements EventSubscriberInterface
{

/**
 * @var MailerInterface
 */
private $mailer;

/**
 * @var EntityManagerInterface
 */
private $entityManager;

/**
 * @var InscriptionMailerService;
 */
private $mailerService;


public function __construct(MailerInterface $mailer, EntityManagerInterface $entityManager,
InscriptionMailerService $mailerService)
{
$this->mailer = $mailer;
$this->entityManager = $entityManager;
$this->mailerService = $mailerService;
}


public static function getSubscribedEvents(): array
{
return [
ContactEvents::NAME => [
['insertcontact', 10],
['updatename', 9],
['sendmail', 8],
],
];
}


public function insertcontact(ContactEvents $event):void

{
$contact  = $event->getContact();
// insert to in bdd
$this->entityManager->persist($contact);
$this->entityManager->flush();
}

public function updatename(ContactEvents $event):void

{
$contact = $event->getContact();
}

public function sendmail(ContactEvents $event) :void
{
$contact = $event->getContact();
$email = $contact->getEmail();

$from =$email;
$to=$email;
$subject ='votre email est bien parvenu !';
$template = 'inscription';
$parameters = [
'mail'=>$contact->getEmail(),
'datas'=>$contact->getName(),
'adresse'=>$contact->getAdresse(),
'subject'=> 'prise en compte de votre demande.',
];

// envoi de l'email via le service
$this->mailerService->sendEmail($to,$from,$subject,$template,$parameters);

}
}
