<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailNewType;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CocktailController extends AbstractController
{
    /* SHOW ALL */
    #[Route('/cocktail', name: 'menu' , priority:-1)]
    public function index(CocktailRepository $cocktail): Response
    {
        $cocktails = $cocktail->findAll();
        return $this->render('cocktail/index.html.twig', [
            'controller_name' => 'CocktailController',
            'cocktails' => $cocktails,
        ]);
    }

    /* SHOW ALL ADMIN */
    #[Route('/admin/cocktail', name: 'adminCocktail')]
    public function listcocktail(CocktailRepository $cocktail): Response
    {
        $cocktails = $cocktail->findAll();
        return $this->render('cocktail/listadmin.html.twig', [
            'controller_name' => 'CocktailController',
            'cocktails' => $cocktails,
        ]);
    }


    /******* CRUD ******/


    /* SHOW ONE */
    #[Route('/cocktail/seeMore/{id}', name: 'seeMore')]
    public function show(int $id, CocktailRepository $cocktailRep): Response
    {
        $cocktail = $cocktailRep->find($id);
        return $this->render('cocktail/seeMore.html.twig', [
            'controller_name' => 'CocktailController',
            'cocktail' => $cocktail,
        ]);
    }

    /* NEW ONE */
    #[Route('/admin/new/cocktail', name: 'newCocktail')]
    public function new(Request $request , EntityManagerInterface $em): Response
    {
        $cocktail = new Cocktail();
        $form = $this->createForm(CocktailNewType::class,$cocktail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cocktail->setActive(false);
            $cocktail->setPriority(false);
            $em->persist($cocktail);
            $em->flush();
            return $this->redirectToRoute('adminCocktail');
        }

        return $this->render('cocktail/newcocktail.html.twig', [
            'form' => $form,
        ]);
    }


    /* EDIT */
    #[Route('/admin/edit/cocktail/{id}', name: 'editCocktail')]
    public function edit(int $id, Cocktail $cocktail, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('adminCocktail');
        }

        return $this->render('cocktail/updatecocktail.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form,
        ]);
    }

    /* DELETE */
    #[Route('/admin/cocktail/delete/{id}', name: 'deleteCocktail')]
    public function delete(EntityManagerInterface $em, Cocktail $cocktail): Response
    {
        $em->remove($cocktail);
        $em->flush();
        return $this->redirectToRoute('adminCocktail');
    }

    /* ACTIVE */
    #[Route('/admin/cocktail/active/{id}', name: 'activeCocktail')]
    public function active(Cocktail $cocktail, EntityManagerInterface $em): Response
    {
        $cocktail->setActive(true);
        $em->persist($cocktail);
        $em->flush();
        return $this->redirectToRoute('adminCocktail');
    }

    /* UNACTIVE */
    #[Route('/admin/cocktail/desactive/{id}', name: 'unactiveCocktail')]
    public function unactive(Cocktail $cocktail, EntityManagerInterface $em): Response
    {
        $cocktail->setActive(false);
        $em->persist($cocktail);
        $em->flush();
        return $this->redirectToRoute('adminCocktail');
    }
}
