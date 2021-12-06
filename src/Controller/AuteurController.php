<?php

namespace App\Controller;
use App\Entity\Auteur;
use App\Entity\Product;
use App\Form\AuteurType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur")
     */
    public function index(): Response
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }

  /**
     * @Route("/auteur/create", name="create")
     */
    
     public function create(Request $request): response

     {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);
       
        return $this->render('auteur/create.html.twig', [
            'controller_name' => 'AuteurController',
            'form' => $form->createView(),
        ]);

     }
}
