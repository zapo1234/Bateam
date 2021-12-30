<?php

namespace App\Controller\Auteur;

use App\Entity\User;
use App\Entity\Auteur;
use App\Entity\Attribution;
use App\Form\AttributionType;
use App\Service\AttributeManager;
use App\Events\Souscribers\ContactSouscriber;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AttributionController extends AbstractController
{
  

private $attribute;

public function __construct(AttributeManager $attribute, EntityManagerInterface $entityManager)
{
  $this->attribute = $attribute;
  $this->entityManager = $entityManager;
}

/**
 * @Route("/editeur/list", name="editeur_list")
 */

 public function list()
 {
   $listes = $this->attribute->getList();
    return $this->renderForm('Profil/attribute_list.html.twig', [
    'listes' => $listes,
    ]);
 }

/**
 * @Route("/editeur/groups", name="editeur_groups")
 */
  
public function index(Request $request) 
{
$attribution = new Attribution();
$form = $this->createForm(AttributionType::class, $attribution);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
  // insert in bdd
  $user = $form->get('user')->getData();
  $attribution->setUser($user);
   $this->attribute->createEditor($attribution);
}

return $this->renderForm('Profil/attribute.html.twig', [
  'form' => $form,
  ]);

}

/**
 * @Route("/editeur/groups/{id}", name="editeur_edit")
 */
  
public function edit(Request $request, Attribution $attribute) 
{
 
$form = $this->createForm(AttributionType::class, $attribute);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
  // ... save the meetup, redirect etc.
  $user = $form->get('user')->getData();
  $attribution->setUser($user);
   $this->attribute->EditEditor($attribution);
}

return $this->renderForm('Profil/attribute_edit.html.twig', [
  'attribute'=> $attribute,
  'form' => $form,
  ]);

}
}
