<?
//$antara=gmdate('Y-m');
$search = "";
$tgl1 = "";
if(!empty($_GET['tgl1'])){
	$tgl1 =$_GET['tgl1']; 
} 

if($tgl1 !=""){
	$search = " where a.TANGGAL BETWEEN '".$tgl1."'";
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
	$search = " where concat(month(a.TANGGAL),year(a.TANGGAL)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}



include("phpgraphlib.php");
include("../../include/connect.php");
$sql1="SELECT a.TANGGAL,
cast(sum(a.TARIFRS*a.kdpoly*(1-abs(sign(a.kdpoly-1)))) as UNSIGNED ) as poli_kd1,
cast(sum(a.TARIFRS*a.kdpoly/2*(1-abs(sign(a.kdpoly-2)))) as UNSIGNED ) as poli_kd2,
cast(sum(a.TARIFRS*a.kdpoly/3*(1-abs(sign(a.kdpoly-3)))) as UNSIGNED ) as poli_kd3, 
cast(sum(a.TARIFRS*a.kdpoly/4*(1-abs(sign(a.kdpoly-4)))) as UNSIGNED ) as poli_kd4,
cast(sum(a.TARIFRS*a.kdpoly/5*(1-abs(sign(a.kdpoly-5)))) as UNSIGNED ) as poli_kd5,
cast(sum(a.TARIFRS*a.kdpoly/6*(1-abs(sign(a.kdpoly-6)))) as UNSIGNED ) as poli_kd6,
cast(sum(a.TARIFRS*a.kdpoly/7*(1-abs(sign(a.kdpoly-7)))) as UNSIGNED ) as poli_kd7,
cast(sum(a.TARIFRS*a.kdpoly/8*(1-abs(sign(a.kdpoly-8)))) as UNSIGNED ) as poli_kd8,
cast(sum(a.TARIFRS*a.kdpoly/9*(1-abs(sign(a.kdpoly-9)))) as UNSIGNED ) as poli_kd9,
cast(sum(a.TARIFRS*a.kdpoly/10*(1-abs(sign(a.kdpoly-10)))) as UNSIGNED ) as poli_kd10,
cast(sum(a.TARIFRS*a.kdpoly/11*(1-abs(sign(a.kdpoly-11)))) as UNSIGNED ) as poli_kd11,
cast(sum(a.TARIFRS*a.kdpoly/28*(1-abs(sign(a.kdpoly-28)))) as UNSIGNED ) as poli_kd12,
cast(sum(a.TARIFRS*a.kdpoly/29*(1-abs(sign(a.kdpoly-29)))) as UNSIGNED ) as poli_kd13,
cast(sum(a.TARIFRS*a.kdpoly/30*(1-abs(sign(a.kdpoly-30)))) as UNSIGNED ) as poli_kd14
FROM t_billrajal a ".$search." and a.kdpoly is not null group by a.TANGGAL";
$qry1=mysql_query($sql1);
$v_total=0;
while($baris=mysql_fetch_assoc($qry1))
{
//$tgl=$baris['kdpoly'];

$data['DALAM']=$baris['poli_kd1'];
$data['KB dan KD']=$baris['poli_kd2'];
$data['ANAK']=$baris['poli_kd3'];
$data['BEDAH']=$baris['poli_kd4'];
$data['GIGI']=$baris['poli_kd5'];
$data['PSIKIATRI']=$baris['poli_kd6'];
$data['NEUROLOGI']=$baris['poli_kd7'];
$data['ANESTESI']=$baris['poli_kd8'];
$data['UGD']=$baris['poli_kd9'];
$data['VK']=$baris['poli_kd10'];
$data['THT']=$baris['poli_kd12'];
$data['MATA']=$baris['poli_kd13'];
$data['PARU']=$baris['poli_kd14'];
$data['RUJUKAN']=$baris['poli_kd11'];
$v_total=$v_total+$baris['poli_kd1']+$baris['poli_kd2']+
$baris['poli_kd3']+$baris['poli_kd4']+$baris['poli_kd5']+
$baris['poli_kd6']+$baris['poli_kd7']+$baris['poli_kd8']+
$baris['poli_kd9']+$baris['poli_kd10']+$baris['poli_kd11']+
$baris['poli_kd12']+$baris['poli_kd13']+$baris['poli_kd14'];

/*

$d1[$tgl]=$data1;
$d2[$tgl]=$data2;
$d3[$tgl]=$data3;
$d4[$tgl]=$data4;
$d5[$tgl]=$data5;
$d6[$tgl]=$data6;
$d7[$tgl]=$data7;
$d8[$tgl]=$data8;
$d9[$tgl]=$data9;
$d10[$tgl]=$data10;
$d11[$tgl]=$data11;
*/

}
$graph=new PHPGraphLib(500,350);
$graph->addData($data);
//$graph->setTitle("REKAP KUNJUNGAN PASIEN DATANG SENDIRI");
//$graph->setLegend(false);
//$graph->setLegendTitle("-");
$graph->setTitle("TOTAL PENDAPATAN [JUMLAH Rp ".number_format($v_total,0)."]");
$graph->setGradient("red", "black");
$graph->setDataValues(true);
$graph->createGraph();
?>
