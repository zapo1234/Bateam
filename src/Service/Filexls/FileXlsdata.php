<?php
namespace App\Service\Filexls;
use App\Entity\Auteur;
use App\Repository\AuteurRepository;
use Doctrine\ORM\EntityManagerInterface;

class FileXlsdata
{
/*
* @var AuteurReposiroty
*/
private $auteurRepository;
/*
*@ var EntityManagerInterface
*/
private $entityManager;

public function __construct(AuteurRepository $auteurRepository, EntityManagerInterface $entityManager)
{
$this->entityManager = $entityManager;
$this->auteurRepository = $auteurRepository;

}

public function DataAuteur() : array
{
$list = [];
$data = $this->auteurRepository->findAll();

foreach($data as $values)
{
$list[]= [
        $values->getName(),
        $values->getLastname(),
        $values->getAge()
        ];
}

return $list;

}

public function getList(): array
{
  return $this->DataAuteur();
}

}
