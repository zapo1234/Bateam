<?php

namespace App\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

Class UserManager
{

/** 
* @var auteurRepository
*/
private $userRepository;
private $entityManager;
private $encoder;

public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository,
UserPasswordEncoderInterface $encoder)

{
  $this->userRepository =$userRepository;
  $this->entityManager = $entityManager;
  $this->encoder = $encoder;
}


// créer un utilisateur 
public function CreateUser(User $user) 
{
if($user instanceof User){
// verification de l'unicité du mail
// on génere le le token 
// On génère un token et on l'enregistre
$user->setToken(md5(uniqid()));
// on enregistre le user
$this->entityManager->persist($user);
$this->entityManager->flush(); 
}
}


public function UpadateUser(User $user) 
{
if($user instanceof User) {
 
  // mise à jour du token
  $user->setToken(md5(uniq()));
  $this->entityManager->remove($user);
  $this->entityManager->flush();
}
}


//encoder les mots de pass
public function encodePassword(User $user,string $password)
{
  $encoded = $this->encoder->encodePassword($user, $password);
  $user->setPassword($encoded);
}


}


