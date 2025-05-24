Configuration :

Création d'un projet :

    symfony new nomDuProjet --webapp

Connexion Base de données :

    DATABASE_URL="mysql://identifiant:motdepasse@127.0.0.1:3306/nom_de_la_table?serverVersion=10.4"

                                           
BDD :

Installation de doctrine :
    
    composer require symfony/orm-pack

Création d'une BDD :

    symfony console doctrine:database:create ou symfony console d:d:c

Création d'une entité : 

    symfony console make:entity nomEntite

Convertir l'entité en SQL :

    symfony console make:migration

Envoyer dans la BDD:

    symfony console doctrine:migration:migrate ou symfony console d:m:m


Validation formulaire :

Conditions:

    use Symfony\Component\Validator\Constraints as Assert;
