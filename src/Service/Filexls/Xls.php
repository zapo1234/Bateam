<?php
namespace App\Service\Filexls;
use App\Entity\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Xls
{

 public function Export(string $titre, string $champs1, string $champs2, string $champs3,
 array $data, string $filename)

 {
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle($titre);
  $sheet->getCell('A1')->setValue($champs1);
  $sheet->getCell('B1')->setValue($champs2);
  $sheet->getCell('C1')->setValue($champs3);
  // Increase row cursor after header write
  $sheet->fromArray($data,null, 'A2', true);
  $writer = new Xlsx($spreadsheet);
  $writer->save($filename);

 }

 // importer les données du files dans la table user;
 public function ImportUser(string $filename, string $filePathName)
 {
    $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file 
    $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array

}

// importer les données du files Auteur dans la table Auteur
public function ImportAuteur(string $filename, string $filePathName)
{
    $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file 
    $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array


}

}





















