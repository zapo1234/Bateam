<?php
namespace App\Event;

use App\Entity\Inscription\Contact;
use Symfony\Contracts\EventDispatcher\Event;


class ContactEvents extends Event
{
const TEMPLATE_CONTACT  = "emails/inscription.html.twig";
const NAME  = 'contact.send';

/**
* contactEvent constructor
* @param Contact $contact
*/

protected $contact;

public function __construct(Contact $contact)
{
$this->contact = $contact;
}

/**
* return Contact
*@param Contact $contact
*/
public function getContact(): Contact
{
return $this->contact;
}

}



