<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\Auteur1Type;
use App\Form\AuteurType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator


/**
 * @Route("/auteurs")
 */
class AuteursController extends AbstractController
{
    private  $entityManager;
    private $auteurRepository;
    public function __construct(EntityManagerInterface $entityManager, AuteurRepository $auteurRepository) {
     $this->entityManager = $entityManager;
     $this->auteurRepository = $auteurRepository;

    }
    
    /**
     * @Route("/", name="auteurs_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        //
        $donnees = $this->getDoctrine()->getRepository(Auteur::class)->findBy([],['id' => 'desc']);

           $auteurs = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );  
        
        return $this->render('auteurs/index.html.twig', [
            'auteurs' => $auteurs,
        ]);
    }

    /**
     * @Route("/new", name="auteurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

          // on recupère la collection
          $originalProducts = new ArrayCollection();
          // on recupere l'association avec profduct
       foreach($auteur->getProdcuts() as $product) {
            $originalProducts->add($product);
          }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($auteur);
            $this->entityManager->flush(); 

            return $this->redirectToRoute('auteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auteurs/new.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="auteurs_show", methods={"GET"})
     */
    public function show(Auteur $auteur): Response
    {
        return $this->render('auteurs/show.html.twig', [
            'auteur' => $auteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="auteurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,Auteur $auteur): Response
    {

        if (null === $auteur = $this->entityManager->getRepository(auteur::class)->find($auteur)) {
            throw $this->createNotFoundException('No task found for id '.$auteur);
        }
        
         $form = $this->createForm(AuteurType::class, $auteur);
         $form->handleRequest($request);
          
        // on recupère la collection
           $originalProducts = new ArrayCollection();
          // on recupere l'association avec profduct
          foreach($auteur->getProdcuts() as $product) {
               $originalProducts->add($product);
            }

           if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
           
            return $this->redirectToRoute('auteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auteurs/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="auteurs_delete", methods={"POST"})
     */
    public function delete(Request $request, Auteur $auteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager(); 
            $entityManager->remove($auteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('auteurs_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
