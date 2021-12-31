<?php
namespace App\Service\Cache;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use App\Entity\Auteur;
use App\Service\AuteurManager;

Class CacheData
{

private $caches;

private $auteur;

public function __construct(CacheInterface $caches, AuteurManager $auteur)
{
  $this->caches = $caches;
  $this->auteur =$auteur;
}

//cacher les données de l'entity Auteur listing findAll
public function CacheAdd(string $name)
{
  // recupérer les données à mettre en cache
  $caches = $this->caches->get(''.$name.'', function(ItemInterface $item){
      $item->expiresAfter(10);
      return $this->auteur->AuteurDesc();
    });
    return $caches;
}

// surpimer le cache pour les edit, regsiter et delete
public function DeleteCache(string $name)
{
 $this->caches->delete(''.$name.'');
}

}


