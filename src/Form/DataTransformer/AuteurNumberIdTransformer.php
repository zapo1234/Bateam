<?php
namespace App\Form\DataTransformer;

use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class AuteurNumberIdTransformer implements DataTransformerInterface
{
private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}

/**
 * Transforms the numeric array (1,2,3,4) to a collection of Categories (Categories[])
 * 
 * @param Array|null $auteur
 * @return array
 */
public function transform($auteur): ?Auteur
{
  if (null === $auteur) {
        return null;
    }
     return $this->entityManager
        ->getRepository(Auteur::class)
        ->find($auteur)
    ;
}

/**
 * In this case, the reverseTransform can be empty.
 * 
 * @param type $value
 * @return array
 */
public function reverseTransform($value)
{
    return [];
}
}