<?php

namespace App\Service;
use App\Entity\Attribution;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AttributionRepository;


Class AttributeManager
{


private $attributeRepository;
private $entityManager;

public function __construct(EntityManagerInterface $entityManager, AttributionRepository $attributeRepository)

{
$this->attributeRepository = $attributeRepository;
$this->entityManager = $entityManager;
}
/*
@ return array list auteur
*/
public function List()
{
$listes = $this->attributeRepository->findAll();
return $listes;
}

// recupérer les listes des utilisateurs dans un tableau 
public function getList():array
{
return $this->List();
}

public function CreateEditor(Attribution $attribution) 
{
// flush en bdd 
$this->entityManager->persist($attribution);
$this->entityManager->flush(); 

}

public function EditEditor(Attribution $attribution) 
{
// flush en bdd 
$this->entityManager->persist($attribution);
$this->entityManager->flush(); 

}

public function DeleteEditor(Attribution $editor) 
{
if($editor instanceof Attribution) {
$this->entityManager->remove($editor);
$this->entityManager->flush();
}
}
}


