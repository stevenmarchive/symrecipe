<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientForm;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;


final class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient',methods: ['GET'])]
    public function index(IngredientRepository $repository,PaginatorInterface $paginator,Request $request): Response
    {

        // Récupère toutes les données de la BDD de la table ingrédients et ajoute le format de pagination
        $ingredients = $paginator->paginate($repository->findAll(), $request->query->getInt('page', 1), 10);

        return $this->render('ingredient/index.html.twig', ['ingredients' => $ingredients]);
    }


    #[Route('/ingredient/nouveau', name: 'app_ingredient_new',methods: ['GET','POST'])]
    public function new(Request $request) : response
    {

        // Récupère les données de la table Ingredient
        $ingredient = new Ingredient();

        // Import les donées du formulaire
        $form = $this->createForm(IngredientForm::class, $ingredient);

        // Lie les données de la requête HTTP au formulaire et à l'entité
        $form->handleRequest($request);


        return $this->render('ingredient/new.html.twig', ['ingredient' => $ingredient, 'form' => $form->createView()]);
    }

}
