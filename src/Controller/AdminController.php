<?php
namespace App\Controller;
use App\Entity\Auteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Auteur1Type;
use App\Repository\AuteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Message\EmailNotifications;

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


    /**
     * @Route("/admin/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(Auteur1Type::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($auteur);
            $this->entityManager->flush(); 

            return $this->redirectToRoute('admin_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/new.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }

      /**
     * @Route("/admin/send", name="admin_email")
     */
    public function send(Request $request, EntityManagerInterface $em): Response
    {
        $task = new Auteur();
        $task->setCreatedAt(new DateTime('now'));
 
        $form = $this->createForm(Auteur::class, $task);
 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
 
            $em->persist($task);
            $em->flush();
 
            $this->dispatchMessage(new EmailNotifications($task->getContent(), $task->getId(), $task->getUser()->getEmail()));
 
            return $this->redirectToRoute('home');
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),

        ]);

}
}
