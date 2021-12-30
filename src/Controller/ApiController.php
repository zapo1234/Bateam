<?php

namespace App\Controller;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class ApiController extends AbstractController
{
private $orderRepository;
private $entityManager;
private $serializer;


public function __construct(EntityManagerInterface $entityManager,OrderRepository $orderRepository,
SerializerInterface $serializer) 
  {
    $this->entityManager = $entityManager;
    $this->orderRepository = $orderRepository;
    $this->serializer = $serializer;
  }

  /**
 * @Route("/api/", name="api_index" ,methods={"GET"})
 */
public function index()
{
      $list = $this->orderRepository->findAll();
      // utiliser la methode de serializer
    return $this->json($list, 200,[], ['groups'=>'order:read']);
}


  /**
 * @Route("/api/store", name="api_store" ,methods={"POST"})
 */
public function store(Request $request, ValidatorInterface $validator)
{
  // recupere le content contenu envoyés
  $json_datas = $request->getContent();
  // on desirialiez les données json en object php
  $order = $this->serializer->deserialize($json_datas, Order::class, 'json');
  // renvoi la date
  $order->setDate(new \DateTime());
  // recupere les erreurs
  $errors = $validator->validate($order);
  if(count($errors) > 0) {
  return $this->json($errors, 400);
  }

  $this->entityManager->persist($order);
  $this->entityManager->flush();

  return $this->json($order, 201, [], ['groups'=>'order:read']);
      
}


/**
 * @Route("/api/edit/{id}", name="api_edit" ,methods={"PUT"})
 */

public function edit(Order $reference , Request $request, ValidatorInterface $validator) 
{
    if(!$reference) {
      return new JsonResponse(['message' => 'article pas trouvé']);
    }
      
    $this->serializer->deserialize(
      $request->getContent(),
      Order::class,
      'json',
      [
          'object_to_populate' => $reference,
          'group' => ['order:read']
      ]
  );
    // renvoi la date
    $reference->setDate(new \DateTime());
    // recupere les erreurs
    $errors = $validator->validate($reference);
    if(count($errors) > 0) {
    return $this->json($errors, 400);
    }
    $this->entityManager->persist($reference);
    $this->entityManager->flush();

return $this->json($reference, 201, [], ['groups'=>'order:read']);
}

}
