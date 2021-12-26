<?php

namespace App\Controller\Auteur;
use App\Service\Profiler\AvartarService;
use App\Service\AuteurManager;
use App\Entity\Auteur;
use App\Entity\Auteur\Deletecheck;
use App\Form\Auteur2Type;
use App\Form\deletecheckAuteur\FormschecksType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileauteurController extends AbstractController
{
  
private $auteurManager;
private $avatarService;

public function __construct(AuteurManager $auteurManager, AvartarService $avatarService)
{
  $this->auteurManager = $auteurManager;
  $this->avartarService = $avatarService;

}

  /**
   * @Route("/profile_list", name="profils")
  */

public function ListAuteur() 

{  
// afficher les listes
$listes = $this->auteurManager->getList();
  // renvoi sur la page suivante
  return $this->renderForm('profil/index.html.twig', [
  'listes' => $listes
]);
}


/**
 * @Route("/profile_user", name="profil")
 */

public function Profile(Request $request, AuteurManager $auteurManager, AvartarService $avatarService): Response

{
    $auteur = new Auteur();
    $form = $this->createForm(Auteur2Type::class, $auteur);
    $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          // on recupere l'image
          $file = $form->get('filename')->getData();
          $avatarService->addAvartar($file, $auteur);
          // on recupere le nouveau nom transmi()
          // on insert dans la base de données
          $auteurManager->createAuteur($auteur);
          // return redirectoroute
          return $this->redirectToRoute('profil_list', [], Response::HTTP_SEE_OTHER);
      }

      return $this->renderForm('auteurs/new.html.twig', [
          'auteur' => $auteur,
          'form' => $form,
      ]);

  }
  

    /**
   * @Route("/{id}/{age}/profil/edit", name="profil_edit", methods={"GET","POST"})
   */

  public function edit_profil(Request $request, Auteur $auteur, AuteurManager $auteurManager, AvartarService $avatarService)
    {
      $form = $this->createForm(Auteur2Type::class, $auteur);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          
        $file = $form->get('filename')->getData();

        if(!empty($file)){
          // on recupere le fichier modifier
          $avatarService->editAuteur($file, $auteur);
        }
          // on insert dans la base de données
          $auteurManager->createAuteur($auteur);
          // return redirectoroute
          return $this->redirectToRoute('profils', [], Response::HTTP_SEE_OTHER);

      }

      return $this->renderForm('profil/edit.html.twig', [
          'auteur' => $auteur,
          'form' => $form,
      ]);
  }


    /**
   * @Route("/profil/delete", name="profil_delete_check")
   */

  public function delete_ckeck(Request $request,AuteurRepository $auteurRepository)

  {
    // recuperer les variables lsiter
    dd($auteurRepository->getCheckid());
  }


}