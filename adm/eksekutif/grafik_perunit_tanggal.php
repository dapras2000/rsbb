<?
include("phpgraphlib.php");
include("../../include/connect.php");
$sql="select date_format(tglreg,'%d-%m-%Y') as tglreg,kdpoly,
			cast(sum(kdpoly*(1-abs(sign(kdpoly-1)))) as UNSIGNED ) as poli_kd1,
			cast(sum(kdpoly/2*(1-abs(sign(kdpoly-2)))) as UNSIGNED ) as poli_kd2,
			cast(sum(kdpoly/3*(1-abs(sign(kdpoly-3)))) as UNSIGNED ) as poli_kd3, 
			cast(sum(kdpoly/4*(1-abs(sign(kdpoly-4)))) as UNSIGNED ) as poli_kd4,
			cast(sum(kdpoly/5*(1-abs(sign(kdpoly-5)))) as UNSIGNED ) as poli_kd5,
			cast(sum(kdpoly/6*(1-abs(sign(kdpoly-6)))) as UNSIGNED ) as poli_kd6,
			cast(sum(kdpoly/7*(1-abs(sign(kdpoly-7)))) as UNSIGNED ) as poli_kd7,
			cast(sum(kdpoly/8*(1-abs(sign(kdpoly-8)))) as UNSIGNED ) as poli_kd8,
			cast(sum(kdpoly/9*(1-abs(sign(kdpoly-9)))) as UNSIGNED ) as poli_kd9,
			cast(sum(kdpoly/10*(1-abs(sign(kdpoly-10)))) as UNSIGNED ) as poli_kd10,
			cast(sum(kdpoly/11*(1-abs(sign(kdpoly-11)))) as UNSIGNED ) as poli_kd11					
FROM t_pendaftaran 	where tglreg between '2009-10-01' and '2009-10-31' GROUP BY tglreg";
$qry=mysql_query($sql);
while($baris=mysql_fetch_assoc($qry))
{
$tgl=$baris['tglreg'];
$kode=$baris['kdpoly'];
$data1=$baris['poli_kd1'];
$data2=$baris['poli_kd2'];
$data3=$baris['poli_kd3'];
$data4=$baris['poli_kd4'];
$data5=$baris['poli_kd5'];
$data6=$baris['poli_kd6'];
$data7=$baris['poli_kd7'];
$data8=$baris['poli_kd8'];
$data9=$baris['poli_kd9'];
$data10=$baris['poli_kd10'];
$data11=$baris['poli_kd11'];
$totalpoly=$baris['tot_poly'];



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
$total[$kode]=$totalpoly;
}
$graph=new PHPGraphLib(500,400);
$graph->addData($d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11);
$graph->setTitle("REKAP KUNJUNGAN PASIEN PERUNIT BERDASARKAN PERBULAN");
$graph->setLegend(false);
$graph->setLegendTitle("Dalam");
$graph->setGradient("red", "yellow");
$graph->createGraph();



?>
