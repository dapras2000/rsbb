<?
include("phpgraphlib.php");
include("../../include/connect.php");
$sql1="select date_format(tglreg,'%d-%m-%Y') as tglreg,kdpoly,
			cast(sum(kdrujuk*(1-abs(sign(kdrujuk-1)))) as UNSIGNED ) as rujuk_kd1,
			cast(sum(kdrujuk/2*(1-abs(sign(kdrujuk-2)))) as UNSIGNED ) as rujuk_kd2,
			cast(sum(kdrujuk/3*(1-abs(sign(kdrujuk-3)))) as UNSIGNED ) as rujuk_kd3, 
			cast(sum(kdrujuk/4*(1-abs(sign(kdrujuk-4)))) as UNSIGNED ) as rujuk_kd4				
FROM t_pendaftaran 	where tglreg between '2009-10-01' and '2009-10-31' GROUP BY tglreg";
$qry1=mysql_query($sql1);
while($baris=mysql_fetch_assoc($qry1))
{
$tgl=$baris['tglreg'];

$data1=$baris['rujuk_kd1'];
$data2=$baris['rujuk_kd2'];
$data3=$baris['rujuk_kd3'];
$data4=$baris['rujuk_kd4'];




$d1[$tgl]=$data1;
$d2[$tgl]=$data2;
$d3[$tgl]=$data3;
$d4[$tgl]=$data4;

}
$graph=new PHPGraphLib(500,400);
$graph->addData($d1,$d2,$d3,$d4);
$graph->setTitle("REKAP KUNJUNGAN PASIEN BERDASARKAN RUJUKAN");
$graph->setLegend(false);
$graph->setLegendTitle("-");
$graph->setGradient("red", "yellow");
$graph->createGraph();



?>
