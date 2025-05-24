<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{

    // Créer des fausses données en français
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {

        // Afin d'avoir une quantité précise de fixtures envoyé
        for ($i = 0; $i <= 50; $i++) {

            // importe les données de l'entité
            $ingredient = new Ingredient();

            // Insère les données de faker dans colonne de la BDD
            $ingredient->setName($this->faker->name());
            $ingredient->setPrice(mt_rand(0,100));

            // Prépare les données à être envoyé dans la BDD
            $manager->persist($ingredient);
        }

        // Envoie les données dans la BDD
        $manager->flush();
    }
}
