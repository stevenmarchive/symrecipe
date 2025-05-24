Configuration :

Création d'un projet :

    symfony new nomDuProjet --webapp
 
Installation Twig :

    composer require symfony/twig-bundle

BDD

Installation de doctrine :
    
    composer require symfony/orm-pack

Connexion Base de données :

    DATABASE_URL="mysql://identifiant:motdepasse@127.0.0.1:3306/nom_de_la_table?serverVersion=10.4"


Création d'une BDD :

    symfony console doctrine:database:create ou symfony console d:d:c

Création d'une entité : 

    symfony console make:entity nomEntite

Convertir l'entité en SQL :

    symfony console make:migration

Envoyer dans la BDD:

    symfony console doctrine:migration:migrate ou symfony console d:m:m


Validation formulaire

Installation :

    composer require symfony/validator

Importation :

    use Symfony\Component\Validator\Constraints as Assert;

Fixtures 

Installation :

    composer require --dev orm-fixtures

Faker

Installation :

    composer require fakerphp/faker

Envoyer les fixtures

    symfony console doctrine:fixtures:load ou symfony console d:f:l


Pagination

Installation : 

    composer require knplabs/knp-paginator-bundle
    Récupèrer le fichier knp_paginator.yaml dans package

Formulaire :

    composer require form
    symfony console make:form 