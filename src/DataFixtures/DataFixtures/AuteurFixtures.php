<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class AuteurFixtures extends Fixture implements DependentFixtureInterface
{
public function load(ObjectManager $manager): void
{
    
  for($nbauteur=0; $nbauteur <5; $nbauteur++)
    {
    $faker = Faker\Factory::create('fr_FR');
    $user= $this->getReference('user_'. $faker->numberbetween(1,3));
    $auteur = new auteur();
    $auteur->setUser($user);
    $auteur->setName($faker->realtext(25));
    $auteur->setLastname($faker->realtext(30));
    $auteur->setAge($faker->numberBetween($min = 20, $max = 900));
    $auteur->setPays($faker->realtext(30));
    $auteur->setAuteur($faker->realtext(30));
    $auteur->setProduit($faker->realtext(30));
    $auteur->setFilename($faker->realtext(30));
    $manager->persist($auteur);

     // enregsitrer l'auteur dans une reference 
     $this->addReference('auteur_' .$nbauteur, $auteur);
    
  }
    $manager->flush();
}

public function getDependencies(){

  return [
      UserFixtures::class
  ];
}
  
}
