<?
//$antara=gmdate('Y-m');
$search = "";
$tgl1 = "";
if(!empty($_GET['tgl1'])){
	$tgl1 =$_GET['tgl1']; 
} 

if($tgl1 !=""){
	$search = " and a.tglreg BETWEEN '".$tgl1."'";
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
	$search = " and concat(month(a.tglreg),year(a.tglreg)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}


include("phpgraphlib.php");
include("phpgraphlib_pie.php");

include("../../include/connect.php");
 $sql="select o.pembedahan, sum(o.id_operasi)as jml
FROM t_pendaftaran a
inner join t_operasi o on (o.idxdaftar=a.idxdaftar)
WHERE o.`status` = 'selesai'
".$search." GROUP BY o.pembedahan";
$qry=mysql_query($sql);
$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$nama=$baris['pembedahan']." [".$baris['jml']."]";
$totalpoly=$baris['jml'];
$total[$nama]=$totalpoly;
$v_total=$v_total+$totalpoly;
}

$graph=new PHPGraphLibPie(500,400);
$graph->addData($total); 
$graph->setTitle("TOTAL PASIEN KAMAR OPERASI BERDASAR JNS PEMBEDAHAN [JUMLAH ".$v_total." PASIEN]");
$graph->setLabelTextColor("50,50,50");
$graph->setLegendTextColor("50,50,50");
$graph->createGraph();
?>
<BODY>
test
</BODY>