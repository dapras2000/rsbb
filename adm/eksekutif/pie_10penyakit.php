<?
$antara=gmdate('Y-m');
include("phpgraphlib.php");
include("phpgraphlib_pie.php");

$search = "";
$tgl1 = "";
if(!empty($_GET['tgl1'])){
	$tgl1 =$_GET['tgl1']; 
} 

if($tgl1 !=""){
	$search = "AND a.TANGGAL BETWEEN '".$tgl1."'";
}

$tgl2 = "";
if(!empty($_GET['tgl2'])){
	$tgl2 =$_GET['tgl2']; 
} 


if($tgl1 !=""){
	if($tgl2 !=""){
		$search = $search." AND '".$tgl2."'";
		}else{
		$search = $search." AND '".$tgl1."'";
	}
}

if($search == ""){
	$search = " AND concat(month(a.TANGGAL),year(a.TANGGAL)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

include("../../include/connect.php");
$sql="SELECT a.ICD_CODE,b.jenis_penyakit, COUNT(a.ICD_CODE) AS jumlah FROM t_diagnosadanterapi a,icd b WHERE a.icd_code=b.icd_code ".$search." GROUP BY a.ICD_CODE ORDER BY jumlah DESC LIMIT 0,10";
$qry=mysql_query($sql);

$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$nama=$baris['jenis_penyakit']." [".$baris['jumlah']."]";
$totalpoly=$baris['jumlah'];
$total[$nama]=$totalpoly;
$v_total=$v_total+$totalpoly;
}

$graph=new PHPGraphLibPie(500,400);
$graph->addData($total); 
$graph->setTitle("TOTAL SEPULUH (10) PENYAKIT TERBANYAK [JUMLAH ".$v_total." PASIEN]");
$graph->setLabelTextColor("50,50,50");
$graph->setLegendTextColor("50,50,50");
$graph->createGraph();
?>
