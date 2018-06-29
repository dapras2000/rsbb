<?
include("phpgraphlib.php");
include("../../include/connect.php");
$sql1="select date_format(tglreg,'%d-%m-%Y') as tglreg,kdpoly,
			cast(sum(kdcarabayar*(1-abs(sign(kdcarabayar-1)))) as UNSIGNED ) as carabayar_kd1,
			cast(sum(kdcarabayar/2*(1-abs(sign(kdcarabayar-2)))) as UNSIGNED ) as carabayar_kd2,
			cast(sum(kdcarabayar/3*(1-abs(sign(kdcarabayar-3)))) as UNSIGNED ) as carabayar_kd3, 
			cast(sum(kdcarabayar/4*(1-abs(sign(kdcarabayar-4)))) as UNSIGNED ) as carabayar_kd4,
			cast(sum(kdcarabayar/5*(1-abs(sign(kdcarabayar-5)))) as UNSIGNED ) as carabayar_kd5			
FROM t_pendaftaran 	where tglreg between '2009-10-01' and '2009-10-31' GROUP BY tglreg";
$qry1=mysql_query($sql1);
while($baris=mysql_fetch_assoc($qry1))
{
$tgl=$baris['tglreg'];

$data1=$baris['carabayar_kd1'];
$data2=$baris['carabayar_kd2'];
$data3=$baris['carabayar_kd3'];
$data4=$baris['carabayar_kd4'];
$data5=$baris['carabayar_kd5'];




$d1[$tgl]=$data1;
$d2[$tgl]=$data2;
$d3[$tgl]=$data3;
$d4[$tgl]=$data4;
$d5[$tgl]=$data5;

}
$graph=new PHPGraphLib(500,400);
$graph->addData($d1,$d2,$d3,$d4,$d5);
$graph->setTitle("REKAP CARA BAYAR PASIEN");
$graph->setLegend(false);
$graph->setLegendTitle("-");
$graph->setGradient("red", "yellow");
$graph->createGraph();



?>
