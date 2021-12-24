<?php

namespace App\Service;
use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AuteurRepository;


Class AuteurManager
{

/** 
* @var auteurRepository
*/
private $auteurRepository;
private $entityManager;

public function __construct(EntityManagerInterface $entityManager, AuteurRepository $auteurRepository)

{
  $this->auteurRepository =$auteurRepository;
  $this->entityManager = $entityManager;
}


/*
@ return array list auteur
*/
public function List()
{
  $listes = $this->auteurRepository->findAll();
  return $listes;
}

// recupérer les listes des utilisateurs dans un tableau 
public function getList():array
{
return $this->List();
}



public function CreateAuteur(Auteur $auteur) 
{
if($auteur instanceof Auteur){
// flush en bdd 
$this->entityManager->persist($auteur);
$this->entityManager->flush(); 
}
}


public function DeleteAuteur(Auteur $auteur) 
{
if($auteur instanceof Auteur) {
  $this->entityManager->remove($auteur);
  $this->entityManager->flush();
}
}
}


