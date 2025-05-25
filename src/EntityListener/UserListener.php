<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * Listener responsable du traitement du mot de passe utilisateur lors des événements de persistance Doctrine.
 *
 * Ce listener encode le mot de passe en clair défini sur l'entité User avant qu'elle ne soit insérée ou mise à jour
 * dans la base de données. Il s'assure également de supprimer le mot de passe en clair après son traitement pour
 * garantir la sécurité.
 *
 * @package App\EntityListener
 */
class UserListener
{
    // Déclare une propriété privée pour stocker le service de hachage de mot de passe
    private UserPasswordHasherInterface $passwordHasher;

    // Constructeur appelé automatiquement par Symfony (grâce à l'autowiring)
    // Il reçoit le service UserPasswordHasherInterface et le stocke dans $this->passwordHasher
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    // Méthode appelée automatiquement par Doctrine avant qu'un nouvel utilisateur soit enregistré en base de données
    public function prePersist(User $user):void
    {
        // Appelle la méthode privée pour encoder le mot de passe
        $this->encodePassword($user);
    }

    // Méthode appelée automatiquement par Doctrine avant la mise à jour d'un utilisateur existant
    public function preUpdate(User $user):void
    {
        // Appelle également la méthode d'encodage du mot de passe
        $this->encodePassword($user);
    }

    // Méthode qui effectue le hachage sécurisé du mot de passe si un mot de passe en clair a été défini
    public function encodePassword(User  $user):void
    {
        // Si aucun mot de passe en clair n'est défini, on ne fait rien
        if ($user->getPlainPassword() === null) {
            return;
        }

        // Sinon, on utilise le hasher pour convertir le mot de passe en clair en mot de passe sécurisé
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,                          // L'utilisateur (utilisé par Symfony pour personnaliser le hashage si besoin)
            $user->getPlainPassword()       // Le mot de passe en clair à encoder
        ));

        // Une fois le mot de passe encodé, on vide plainPassword pour qu’il ne soit jamais stocké
        $user->setPlainPassword(null);
    }
}
