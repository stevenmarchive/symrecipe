<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AuthentificationController extends AbstractController
{
    #[Route('/authentification', name: 'auth_login', methods: ['GET','POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $data = [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'lastUsername' => $authenticationUtils->getLastUsername()
        ];


        return $this->render('authentification/index.html.twig', $data);
    }


    #[Route('/deconnexion', name: 'auth_logout', methods: ['GET','POST'])]
    public function logout(): Response
    {

    }



}
