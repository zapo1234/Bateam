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
     * @Route("/api", name="api")
     */
    public function index()
    {
         $list = $this->orderRepository->findAll();
         // utiliser la methode de serializer
        return $this->json($list, 200,[], ['groups'=>'order:read']);
    }


     /**
     * @Route("/api/strore", name="api_store")
     */
    public function store(Request $request, ValidatorInterface $validator)
    {
      // recupere le content contenu envoyés
      $json_datas = $request->getContent();
     // on desirialiez les données json en object php
      $order = $this->serialize->deserialize($json_datas, Order::class, 'json');
      // renvoi la date
      $order->setDate(new \Date);
      // recupere les erreurs
      $errors = $validator->validate($order);

      if(count($erros) > 0) {
      return $this->json($errors, 400);
      }
         
    }



}
