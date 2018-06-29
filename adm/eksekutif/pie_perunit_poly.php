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

$sql="select date_format(a.tglreg,'%d-%m-%Y') as tglreg,a.kdpoly,b.nama,
			cast(sum(a.kdpoly*(1-abs(sign(a.kdpoly-1)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/2*(1-abs(sign(a.kdpoly-2)))) as UNSIGNED )+
			cast(sum(a.kdpoly/3*(1-abs(sign(a.kdpoly-3)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/4*(1-abs(sign(a.kdpoly-4)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/5*(1-abs(sign(a.kdpoly-5)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/6*(1-abs(sign(a.kdpoly-6)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/7*(1-abs(sign(a.kdpoly-7)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/8*(1-abs(sign(a.kdpoly-8)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/9*(1-abs(sign(a.kdpoly-9)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/10*(1-abs(sign(a.kdpoly-10)))) as UNSIGNED ) +
			cast(sum(a.kdpoly/11*(1-abs(sign(a.kdpoly-11)))) as UNSIGNED ) +
                        cast(sum(a.kdpoly/28*(1-abs(sign(a.kdpoly-28)))) as UNSIGNED ) +
                        cast(sum(a.kdpoly/29*(1-abs(sign(a.kdpoly-29)))) as UNSIGNED ) +
                        cast(sum(a.kdpoly/30*(1-abs(sign(a.kdpoly-30)))) as UNSIGNED ) as tot_poly
FROM t_pendaftaran a,m_poly b where a.kdpoly=b.kode ".$search." GROUP BY a.kdpoly ORDER BY a.tglreg DESC";
$qry=mysql_query($sql);
$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$kode=$baris['kdpoly'];
$nama=$baris['nama']." [".$baris['tot_poly']."]";
$totalpoly=$baris['tot_poly'];
$total[$nama]=$totalpoly;
$v_total=$v_total+$totalpoly;
}

$graph=new PHPGraphLibPie(500,400);
$graph->addData($total); 
$graph->setTitle("TOTAL KUNJUNGAN PASIEN PERUNIT PERPOLY [JUMLAH ".$v_total." PASIEN]");
$graph->setLabelTextColor("50,50,50");
$graph->setLegendTextColor("50,50,50");
$graph->createGraph();
?>
<BODY>
test

</BODY>
