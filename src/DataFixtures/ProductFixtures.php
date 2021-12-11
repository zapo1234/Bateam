<?php

namespace App\DataFixtures;
use App\Entity\Auteur;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($nbproduct =1; $nbproduct < 10; $nbproduct++) {
         $auteur= $this->getReference('auteur_'. $faker->numberbetween(1,3));

         $product = new Product();
         $product->setAuteur($auteur);
         $product->setName($faker->realtext(25));
         $product->setDesignation($faker->realtext(30));
         $manager->persist($product);

        }
        $manager->flush();
    }

    public function getDependencies(){

        return [
            AuteurFixtures::class
        ];
    }
}
