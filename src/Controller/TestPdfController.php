<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Filepdf\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;

class TestPdfController extends AbstractController
{

private $servicePdf;

public function __construct(Pdf $servicePdf)
{
    $this->servicePdf = $servicePdf;
}

/**
 * @Route("/test/pdf", name="test_pdf")
*/
public function index(): Response
{
    $namefile ="test_pdf.html.twig";
    // on lance le télechargement
    $this->servicePdf->createPdf($namefile);

}

}
