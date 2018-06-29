<?php
require_once('../include/connect.php');  
function datediff($d1, $d2){
	$d1 = (is_string($d1) ? strtotime($d1) : $d1);
	$d2 = (is_string($d2) ? strtotime($d2) : $d2);
	$diff_secs = abs($d1 - $d2);
	$base_year = min(date("Y", $d1), date("Y", $d2));
	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	return array(
	"years" => date("Y", $diff) - $base_year,
	"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
	"months" => date("n", $diff) - 1,
	"days_total" => floor($diff_secs / (3600 * 24)),
	"days" => date("j", $diff) - 1,
	"hours_total" => floor($diff_secs / 3600),
	"hours" => date("G", $diff),
	"minutes_total" => floor($diff_secs / 60),
	"minutes" => (int) date("i", $diff),
	"seconds_total" => $diff_secs,
	"seconds" => (int) date("s", $diff)
	);
}


$query_rscetak = "SELECT a.idxorderrad,a.no_film,a.nomr, b.nama as namapasien, b.jeniskelamin, b.tgllahir, a.polypengirim,e.nama, c.namadokter, d.nama_rad as nama_rad, f.kdcarabayar,g.nama as carabayar, a.tglperiksa as tglorder, 
DATE_FORMAT(a.tglperiksa, '%d/%m/%Y') as tglperiksa,
a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak, a.hasilresume,a.diagnosa  FROM t_radiologi a, m_pasien b, m_dokter c, m_radiologi d,m_poly e,t_pendaftaran f, m_carabayar g WHERE a.nomr = b.nomr AND c.kddokter = a.drpengirim AND a.jenisphoto = d.kd_rad AND a.polypengirim=e.kode AND a.nomr=f.nomr and a.idxdaftar=f.idxdaftar and f.kdcarabayar=g.kode and a.jenisfilm <>'' and a.idxorderrad='".$_GET['idorder']."'";
$rscetak = mysql_query($query_rscetak) or die(mysql_error());
$row_rscetak = mysql_fetch_assoc($rscetak);
$totalRows_rscetak = mysql_num_rows($rscetak);
$a = datediff($row_rscetak['tgllahir'], $row_rscetak['tglorder']);
$umur=$a[years]." thn ".$a[months]." bln ".$a[days]." hr"; 

require('fpdf.php');

class PDF extends FPDF
{
var $B;
var $I;
var $U;
var $HREF;

function PDF($orientation='P',$unit='mm',$format='A4')
{
	$this->FPDF($orientation,$unit,$format);
	$this->B=0;
	$this->I=0;
	$this->U=0;
	$this->HREF='';
}

function WriteHTML($html)
{
	$html=str_replace("\n",' ',$html);
	$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
	foreach($a as $i=>$e)
	{
		if($i%2==0)
		{
			if($this->HREF)
				$this->PutLink($this->HREF,$e);
			else
				$this->Write(5,$e);
		}
		else
		{
			if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
			else
			{
				$a2=explode(' ',$e);
				$tag=strtoupper(array_shift($a2));
				$attr=array();
				foreach($a2 as $v)
				{
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])]=$a3[2];
				}
				$this->OpenTag($tag,$attr);
			}
		}
	}
}

function OpenTag($tag,$attr)
{
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,true);
	if($tag=='A')
		$this->HREF=$attr['HREF'];
	if($tag=='BR')
		$this->Ln(5);
}

function CloseTag($tag)
{
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
	if($tag=='A')
		$this->HREF='';
}

function SetStyle($tag,$enable)
{
	$this->$tag+=($enable ? 1 : -1);
	$style='';
	foreach(array('B','I','U') as $s)
	{
		if($this->$s>0)
			$style.=$s;
	}
	$this->SetFont('',$style);
}

function PutLink($URL,$txt)
{
	$this->SetTextColor(0,0,255);
	$this->SetStyle('U',true);
	$this->Write(5,$txt,$URL);
	$this->SetStyle('U',false);
	$this->SetTextColor(0);
}
}


$pdf=new PDF();
$pdf->AddPage();
$pdf->Image('../img/log.png',20,12,20,25);
$pdf->SetFont('Arial','',14);
$pdf->Cell(0,7,strtoupper($header1),0,1,'C');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,7,strtoupper($header2),0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,7,$header3,0,1,'C');
$pdf->Cell(0,7,$header4,0,1,'C');
$pdf->SetLineWidth(0.4);
$pdf->Line(20, 39, 190, 39);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,15,'HASIL PEMERIKSAAN RONTGEN',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->SetXY(20,55);
$pdf->SetLeftMargin(20);
$pdf->Cell(0,7,'Nama : '.$row_rscetak['namapasien'],0,1,'');
$pdf->Cell(0,10,'Pemeriksaan : '.$row_rscetak['nama_rad'],0,1,'');

$pdf->SetXY(120,55);
$pdf->SetLeftMargin(120);

$pdf->Cell(0,7,'Jenis:Lk/Pr,Umur :'.$umur,0,1,'');
$pdf->Cell(0,10,'Permintaan Dr :'.$row_rscetak['namadokter'],0,1,'');

$pdf->SetXY(120,80);
$pdf->SetLeftMargin(120);
$pdf->Cell(0,7,'Jakarta '.$row_rscetak['tglperiksa'],0,1,'');
$pdf->SetXY(20,90);
$pdf->SetLeftMargin(20);
$pdf->Cell(0,10,'Teman Sejawat Yth',0,1,'C');
$pdf->WriteHTML($row_rscetak['hasilresume']);
$pdf->SetXY(120,215);
$pdf->SetLeftMargin(120);
$pdf->Cell(0,7,'Dokter Pemeriksa',0,1,'');
$pdf->Output();
?>
