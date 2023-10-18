<?php

namespace App\Controller;

use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CocktailController extends AbstractController
{
    #[Route('/cocktail', name: 'menu' , priority:-1)]
    public function index(CocktailRepository $cocktail): Response
    {
        $cocktails = $cocktail->findAll();
        return $this->render('cocktail/index.html.twig', [
            'controller_name' => 'CocktailController',
            'cocktails' => $cocktails,
        ]);
    }

    #[Route('/admin/cocktail', name: 'adminCocktail')]
    public function listcocktail(CocktailRepository $cocktail): Response
    {
        $cocktails = $cocktail->findAll();
        return $this->render('cocktail/listadmin.html.twig', [
            'controller_name' => 'CocktailController',
            'cocktails' => $cocktails,
        ]);
    }
}
