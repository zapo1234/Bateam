<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuteurRepository;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
   
    private $entityManager;
    private $auteurRepository;
   
    public function __construct(EntityManagerInterface $entityManager, AuteurRepository $auteurRepository) {
    
        $this->entityManager = $entityManager;
        $this->auteurRepository = $auteurRepository;

    }
   
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


     /**
     * @Route("/admin/csv", name="admin_csv")
     */
    public function csv(): Response
    {
        $list = $this->auteurRepository->findAll();
        // initilialistation d'un tableau de ligne du fichier csv
        $row = [];
        $b = [];
        $string = "Nom; Prenom; Age; Pays;\n";
        $row [] = $string;
        foreach($list as $values) {
         $data = array($values->getName(), $values->getLastname(), $values->getAge(), $values->getPays());
          // tranformer le tableau en chaine de caractère et l'inculre de votre tableau
          $row[] = implode(';', $data);
        }

        
        $content = implode("\n", $row);
        // renvoi une response
        $response = new Response($content);
        $response->headers->set('Content-type','text/csv');

        return $response;
    
        
        return $this->render('admin/csvlist.html.twig', [
            'controller_name' => 'AdminController',
            'list' => $list
        ]);
    }

}
