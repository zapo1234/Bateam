<?php
namespace App\Service\Filexls;
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



}





















