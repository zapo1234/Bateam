<?php
// src/Form/DataTransformer/CategoriesToNumbersTransformer.php
namespace App\Form\DataTransformer;

use App\Entity\User;
use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UserNumberIdTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * Transforms the numeric array (1,2,3,4) to a collection of Categories (Categories[])
     * 
     * @param Array|null $user
     * @return array
     */
    public function transform($user): ?User
    {
     if (null === $user) {
            return null;
        }
         return $this->entityManager
            ->getRepository(User::class)
            ->find($user);
        ;
    }

    /**
     * In this case, the reverseTransform can be empty.
     * 
     * @param type $value
     * @return array
     */
    public function reverseTransform($user): ?User
    {
        if (null === $user) {
            return null;
        }
         return $this->entityManager
            ->getRepository(User::class)
            ->find($user);
        ;
    }
}