<?php

namespace App\Controller\Auteur;

use App\Entity\Inscription\Contact;
use App\Form\Inscription\InscriptionType;
use App\Service\Mailer\InscriptionMailerService;
use App\Event\ContactEvents;
use App\Events\Souscribers\ContactSouscriber;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class InscriptionController extends AbstractController
{

private  $eventDispatcher;

public function __construct(EventDispatcherInterface $eventDispatcher)
{
    $this->eventDispatcher = $eventDispatcher;
}

/**
 * @Route("/inscription", name="profil_inscription")
 */

public function Inscription(Request $request,InscriptionMailerService $mailer)

{
// création de l'object contact
$contact = new Contact();
// initilisation du formulaire de contact
$form = $this->createForm(InscriptionType::class, $contact);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {

$event = new ContactEvents($contact);
 $this->eventDispatcher->dispatch($event, ContactEvents::NAME);


/*    // traitement des données de fomrulaire 
$parameters = [
'mail'=>$form->get('email')->getData(),
'datas'=>$form->get('name')->getData(),
'adresse'=>$form->get('adresse')->getData(),
'subject'=> 'prise en compte de votre demande.',
];

//envoi du mail via le service
$mailer->sendEmail(
$form->get('email')->getData(),
$form->get('email')->getData(),
'Votre mail est bien parvenu',
'inscription',
$parameters

);
*/

}
return $this->renderForm('Profil/Inscription/new.html.twig', [
'contact' => $contact,
'form' => $form,
]);
}

}