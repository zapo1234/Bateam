<?php

namespace App\DataFixtures;
use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // creation d'un tableau auteur

        $auteurs = [
             1=> [
               "name"=>'zapo',
               "lastname"=>'martial',
               "age" => 14,
               "pays" => "cote d'ivoire"
             ],

             2=> [
                "name"=>'kouassi',
                "lastname"=>'martial',
                "age" => 22,
                "pays" => "cote d'ivoire"
              ],

              3 => [
                "name"=>'konan',
                "lastname"=>'martial',
                "age" => 22,
                "pays" => "cote d'ivoire"
              ],
 
              
              4 => [
                "name"=>'adou',
                "lastname"=>'herve',
                "age" => 22,
                "pays" => "cote d'ivoire"
              ],

             
        ];

        // je boucle sur mon tableau 
         foreach($auteurs as $keys => $values) {
             $auteur = new Auteur();
             $auteur->setName($values['name']);
             $auteur->setLastname($values['lastname']);
             $auteur->setAge($values['age']);
             $auteur->setPays($values['pays']);
             $manager->persist($auteur);

             // enregsitrer l'auteur dans une reference 
             $this->addReference('auteur_' .$keys, $auteur);
        }

        $manager->flush();
    }
}
