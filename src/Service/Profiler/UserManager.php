<?php

namespace App\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
  $this->encode = $encoder;
}


public function CreateUser(User $user, string $email, string $password) 
{
if($user instanceof User){
// verification de l'unicité du mail
$user = $this->userRepository->findByOne($email);
if(!$user) {
    return('l\'email existe deja');
}

// on encode le mot de pass du user
// verifier si emmail est deja dans la base 
$user->setPassword(
    $this->encode->encodePassword(
        $user,
        $password
    )
);
$this->entityManager->persist($user);
$this->entityManager->flush(); 
}
}


public function UpadateUser(User $user) 
{
if($user instanceof User) {
  $this->entityManager->remove($user);
  $this->entityManager->flush();
}
}
}


