<?php
require('fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetXY(20,25);
$pdf->SetFont('Arial','U',12);
$pdf->Cell(0,8,'RUJUKAN BPJS',0,1,'C');
$pdf->SetFont('Arial','',10);
//$pdf->Cell(0,0,'Nomor : '.$_POST['KODERS'].' /        /      /        / '.$_POST['RS'],0,1,'C');
$pdf->Cell(0,0,'Nomor : '.$_POST['KODERS'].' / '.$_POST['NOSURAT'].' / '.$_POST['BLN'].' / '.$_POST['THN'].' / '.$_POST['RS'],0,1,'C');
$pdf->SetXY(20,40);
$pdf->SetLeftMargin(20);
$pdf->Cell(0,5,'Yth. Teman Sejawat ',0,1,'');
$pdf->Cell(0,5,'Rumah Sakit ',0,1,'');
$pdf->Cell(0,5,'Di  ',0,1,'');
$pdf->Cell(0,5,'',0,1,'');
$pdf->Cell(0,5,'Mohon pemeriksaan / pengobatan lebih lanjut untuk penderita : ',0,1,'');
$pdf->Cell(0,5,'No. RM  ',0,1,'');
$pdf->Cell(0,5,'Nama Pasien ',0,1,'');
$pdf->Cell(0,5,'Umur ',0,1,'');
$pdf->Cell(0,5,'Status Jaminan  ',0,1,'');
$pdf->Cell(0,5,'Nama Kepala Keluarga  ',0,1,'');
$pdf->Cell(0,5,'Diagnosa Sementara  ',0,1,'');
$pdf->Cell(0,5,'Keterangan  ',0,1,'');
$pdf->Cell(0,5,'Atas bantuan sejawat kami ucapkan terimakasih.  ',0,1,'');

$pdf->SetXY(120,100);
$pdf->SetLeftMargin(120);
$pdf->Cell(0,5,'Jakarta '.$_POST['tglreg'],0,1,'');
$pdf->Cell(0,5,'Dokter Pemeriksa,   ',0,1,'');
$pdf->Cell(0,5,'',0,1,'');
$pdf->Cell(0,5,'',0,1,'');
$pdf->Cell(0,5,'dr. '.$_POST['DOKTER2'],0,1,'');
$pdf->Cell(0,5,'NIP '.$_POST['NIP2'],0,1,'');

$pdf->SetXY(68,40);
$pdf->SetLeftMargin(68);
$pdf->Cell(0,5,': '.$_POST['DOKTERRUJUK'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['RSRUJUK'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['KOTARS'],0,1,'');
$pdf->Cell(0,5,'',0,1,'');
$pdf->Cell(0,5,'',0,1,'');
$pdf->Cell(0,5,': '.$_POST['NOMR'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['NAMA'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['umur'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['crbayar'].'  /    Nomor  : '.$_POST['PESERTA'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['KK'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['DIAGNOSA'],0,1,'');
$pdf->Cell(0,5,': '.$_POST['TERAPI'],0,1,'');
$pdf->Output();
?>
