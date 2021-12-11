<?php

namespace App\Controller;
use App\Entity\Auteur;
use App\Entity\Product;
use App\Form\AuteurType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Collections\ArrayCollection;
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
        
        if ($form->isSubmitted()) {

        // on recupère la collection
         $originalProducts = new ArrayCollection();
            // on recupere l'association avec profduct
         foreach($auteur->getProdcuts() as $product) {
              $originalProducts->add($product);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();

            // redirecto route succeesdk
            return $this->redirectToRoute('create');
    }
       
        return $this->render('auteur/create.html.twig', [
            'controller_name' => 'AuteurController',
            'form' => $form->createView(),
        ]);

     }

      /**
     * @Route("/{id}/edit", name="auteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Auteur $auteur): Response
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auteur/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }
    
    
}
