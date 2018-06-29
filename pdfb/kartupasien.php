<?php
error_reporting (E_ALL);  
require('pdfb/pdfb.php');
require('includes/BarcodeBase.php');
require('includes/Code39.php');

$bcode = array();
$bcode['c39']	= array('name' => 'Code39', 'obj' => new emberlabs\Barcode\Code39());

class PDF extends PDFB {
    function Header() {
    }

    function Footer() {
        //$this->Text(402, 735, "Dynamic PDF: PDFB Library!");
    }

 }

// Create a PDF object and set up the properties
$pdf = new PDF("p", "mm", array(85,54));
$pdf->SetAuthor("PDFB Library");
$pdf->SetTitle("Kartu Pasien");

$pdf->SetFont("Arial", "", 8);
$pdf->SetAutoPageBreak(false);

// Load the base PDF into template
$pdf->setSourceFile("kartu_pasien.pdf");
$tplidx = $pdf->ImportPage(1);

// Add new page & use the base PDF as template
$pdf->AddPage();
$pdf->useTemplate($tplidx);

// Probably load Packing Slip information from a database.
//$pkgslip = rand(1000,9999);


//$pdf->SetLeftMargin(20);
//$pdf->SetRightMargin(15);
//$pdf->Text(5, 28.5, $_GET['NOMR']);
//$pdf->Text(5, 36.5, $_GET['NAMA']);

if(strtoupper($_GET['JENISKELAMIN'])=="P"){
$jnskel = "Perempuan";
}
else{
$jnskel = "Laki-Laki";};
$pdf->Text(32, 23.5, $_GET['NOMR']);
$pdf->Text(32, 27.5, $_GET['NAMA']);
$pdf->Text(32, 32, $_GET['TGLLAHIR']);
$pdf->Text(32, 35.5, $jnskel);
/*$pdf->Text(32, 35.5, $jnskel);*/
$pdf->SetXY(31,37.5);
$pdf->MultiCell(0,2.5,$_GET['ALAMAT'],0,"L");
foreach($bcode as $k => $value)
	{
		try
		{
			$bcode[$k]['obj']->setData($_GET['NOMR']);
			$bcode[$k]['obj']->setDimensions(145, 25);
			$bcode[$k]['obj']->draw();
			$b64 = $bcode[$k]['obj']->base64();
			$pdf->Image("data:image/png;base64,".$b64, 31.5,41, 51.5,8, "PNG");
		}
		catch (Exception $e)
		{
			
		}
	}

$pdf->Output();
$pdf->closeParsers();
?>