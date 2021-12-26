<?php
namespace App\Service\Filepdf;
use Twig\Environment;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Routing\Annotation\Route;

class Pdf  
{

 private $twig;

 public function __construct(Environment $environment)
{
    $this->twig = $environment;
}

public function createPdf(string $namefile)
{

// recupere le nom du fichier
$namefile ='test_book.html.twig';
// Configure Dompdf according to your needs
$pdfOptions = new Options();
$pdfOptions->set('isHtml5ParserEnabled', true);
$pdfOptions->set('isRemoteEnabled', true);
$pdfOptions->set('defaultFont', 'Arial');


// Instantiate Dompdf with our options
$dompdf = new Dompdf($pdfOptions);

// Retrieve the HTML generated in our twig file
    $html = $this->twig->render('test_pdf/'.$namefile, [
        'title' => "Télecharger votre book"
    ]);

// Load HTML to Dompdf
$dompdf->loadHtml($html);
    
// (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser (force download)
$dompdf->stream("test_pdf.pdf", [
"Attachment" => false
]);

}

}









