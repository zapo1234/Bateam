<?php
namespace App\Service\Profiler;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Entity\Auteur;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AvartarService

{
private $slugger;
private $params;

public function __construct(SluggerInterface $slugger, ParameterBagInterface $params)
{
  $this->slugger = $slugger;
  $this->params = $params;
}

public function addAvartar(UploadedFile $upload, Auteur $auteur)
  {
  
  if($upload instanceof UploadedFile  AND $auteur instanceof Auteur){
  // on génere un nouveau nom de fichier
  $name_fichier  = md5(uniqid()).'.'.$upload->guessExtension();
  // on copie le fichier sur le dossier 
  $upload->move(
      $this->params->get('images_pictures'),
      $name_fichier
  );
  // modification de filename en bdd
  $auteur->setFilename($name_fichier);

  }
}


public function editAuteur(UploadedFile $upload , Auteur $auteur)

  {
  if($upload instanceof UploadedFile  AND $auteur instanceof Auteur){
    
    // suppression du fichier existant
    $filename = $auteur->getFilename();
    // On supprime le fichier
    unlink($this->params->get('images_pictures').'/'.$filename);
    // on génere un nouveau nom de fichier
    $name_fichier  = md5(uniqid()).'.'.$upload->guessExtension();
    // on copie le fichier sur le dossier 
    $upload->move(
        $this->params->get('images_pictures'),
        $name_fichier
    );
    // modification de filename en bdd
    $auteur->setFilename($name_fichier);
    
  }

}


}