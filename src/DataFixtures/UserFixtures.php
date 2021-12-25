<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class UserFixtures extends Fixture
{
public function load(ObjectManager $manager): void
{
    // creation d'un tableau auteur

    $users = [
            1=> [
            "email"=>'zapo@yahoo.fr',
            "roles" => ['ROLE_USER'],
            "password"=>'$2y$13$.dNfEBn4kd1AFmRJ2BzjHOINIU2NwtVSlGeHfO/sFprXwiAfGpt2e',
            "is_verified" => "1",
            "adresse"=> "22 rue de la pradelle",
            "token"=>"zooekdkdPoiii"
        
            ],

            2=> [
            "email"=>'zapo@yaho.fr',
            "roles" => ['ROLE_ADMIN'],
            "password"=>'$2y$13$.dNfEBn4kd1AFmRJ2BzjHOINIU2NwtVSlGeHfO/sFprXwiAfGpt2e',
            "is_verified" => "0",
            "adresse"=> "22 rue de la pradelle",
            "token"=>"zsldlffffk"
        
            ],

            
            3=> [
            "email"=>'za@yahoo.com',
            "roles" => ['ROLE_ADMIN'],
            "password"=>'$2y$13$.dNfEBn4kd1AFmRJ2BzjHOINIU2NwtVSlGeHfO/sFprXwiAfGpt2e',
            "is_verified" => "1",
            "adresse"=> "22 rue de la pradelle",
            "token"=>"dlfjgj98877"
        
            ],

            
    ];

    // je boucle sur mon tableau 
        foreach($users as $keys => $values) {
            $user = new User();
            $user->setEmail($values['email']);
            $user->setPassword($values['password']);
            $user->setRoles($values['roles']);
            $user->setAdresse($values['adresse']);
            $user->setToken($values['token']);
            $manager->persist($user);
         // enregsitrer l'auteur dans une reference 
         $this->addReference('user_' .$keys, $user);
    }

    $manager->flush();
}
}
