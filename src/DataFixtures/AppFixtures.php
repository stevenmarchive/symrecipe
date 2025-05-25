<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    // Créer des fausses données en français
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {

        $this->ingredientFixtures($manager);
        $this->userFixtures($manager);
        $manager->flush();
    }


    private function ingredientFixtures($manager): void
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
    }

    private function userFixtures($manager): void
    {

        for ($i = 0; $i <= 10; $i++) {
            $user = new User();
            $user->setFullname($this->faker->name());
            $user->setPseudo( mt_rand(0,1) === 1 ? $this->faker->firstName() : null);
            $user->setEmail($this->faker->email());
            $user->setPlainPassword('password');
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }
    }


}
