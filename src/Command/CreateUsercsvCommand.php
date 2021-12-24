<?php

namespace App\Command;

use App\Entity\Auteur;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\AuteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CreateUsercsvCommand extends Command
{
    private  $io;
    private  $uploadsDirectory;
    private  $entitManager;
    private  $auteurRepository;

    public function __construct(EntityManagerInterface $entityManager,  string $uploadsDirectory, 
    AuteurRepository $auteurRepository) {
       
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->auteurRepository = $auteurRepository;
        $this->uploadsDirectory = $uploadsDirectory;
    }

    protected static $defaultName = 'app:create-auteurs-from-file';
    protected function configure(): void
    {
        $this->setDescription('importer des données csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
         $this->CreateUsers();
        return Command::SUCCESS;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
         $this->io = new SymfonyStyle($input, $output);
    }


    private function getDataFromfile():array
    {
        $file = $this->uploadsDirectory . 'csv.csv';
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        
        // encoders 
         $encoders = [new CsvEncoder(), new XmlEncoder()];
         $normalizers = [new ObjectNormalizer()];

         // serialize un object 
         $serializer = new Serializer($normalizers, $encoders);
         // recuperer sur forme de chaine de caractère le fichier
         $filestring = file_get_contents($file);
         // serialiez le fichier en tableau d'object
         $data = $serializer->decode($filestring, $fileExtension);
         
         $data1 =[];
          foreach ($data as $keys => $values){
               
            foreach($values as $val){
                $data1[] =$val;
            }
          }

        dd($data1);
           
    }

    public function CreateUsers(): void
    {
        $this->io->section('creations des utilisateurs Auteurs');

        $this->getDataFromfile();

    }
}
