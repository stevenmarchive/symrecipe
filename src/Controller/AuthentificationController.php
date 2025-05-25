<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationForm;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\EntityListeners;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AuthentificationController extends AbstractController
{
    #[Route('/connexion', name: 'auth_login', methods: ['GET','POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $data = [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'lastUsername' => $authenticationUtils->getLastUsername()
        ];

        return $this->render('authentification/index.html.twig', $data);
    }


    #[Route('/deconnexion', name: 'auth_logout', methods: ['GET','POST'])]
    public function logout()
    {

    }


    #[Route('/inscription', name: 'auth_registration', methods: ['GET','POST'])]
    public function registration(Request $request,EntityManagerInterface $manager): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $this->addFlash('success','Votre compte a bien été créer.');
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('auth_login');
        }



        $data = [
            'form' => $form->createView()
        ];
        return $this->render('authentification/registration.html.twig', $data);
    }

}
