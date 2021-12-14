<?php
namespace App\Form\DataTransformer;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ProductNumberIdTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * Transforms the numeric array (1,2,3,4) to a collection of Categories (Categories[])
     * 
     * @param Array|null $product
     * @return array
     */
    public function transform($ProductNumber): array
    {
        $result = [];
        
        if (null === $ProductNumber) {
            return $result;
        }
        
        return $this->entityManager
            ->getRepository(Product::class)
            ->findBy(["id" => $ProductNumber])
        ;
    }

    /**
     * In this case, the reverseTransform can be empty.
     * 
     * @param type $value
     * @return array
     */
    public function reverseTransform($value): array
    {
        return [];
    }
}