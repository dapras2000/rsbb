<?
//$antara=gmdate('Y-m');

$search = "";
$tgl1 = "";
if(!empty($_GET['tgl1'])){
	$tgl1 =$_GET['tgl1']; 
} 

if($tgl1 !=""){
	$search = " and a.masukrs BETWEEN '".$tgl1."'";
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
	$search = " and concat(month(a.masukrs),year(a.masukrs)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}


include("phpgraphlib.php");
include("phpgraphlib_pie.php");

include("../../include/connect.php");

$sql="select date_format(a.masukrs,'%d-%m-%Y') as masukrs,a.noruang,b.nama,
			cast(sum(a.noruang*(1-abs(sign(a.noruang-1)))) as UNSIGNED ) +
			cast(sum(a.noruang/2*(1-abs(sign(a.noruang-2)))) as UNSIGNED )+
			cast(sum(a.noruang/3*(1-abs(sign(a.noruang-3)))) as UNSIGNED ) +
			cast(sum(a.noruang/4*(1-abs(sign(a.noruang-4)))) as UNSIGNED ) +
			cast(sum(a.noruang/5*(1-abs(sign(a.noruang-5)))) as UNSIGNED ) +
			cast(sum(a.noruang/6*(1-abs(sign(a.noruang-6)))) as UNSIGNED ) +
			cast(sum(a.noruang/7*(1-abs(sign(a.noruang-7)))) as UNSIGNED ) +
			cast(sum(a.noruang/8*(1-abs(sign(a.noruang-8)))) as UNSIGNED ) +
			cast(sum(a.noruang/9*(1-abs(sign(a.noruang-9)))) as UNSIGNED ) +
			cast(sum(a.noruang/10*(1-abs(sign(a.noruang-10)))) as UNSIGNED ) +
			cast(sum(a.noruang/11*(1-abs(sign(a.noruang-11)))) as UNSIGNED ) +
            cast(sum(a.noruang/12*(1-abs(sign(a.noruang-12)))) as UNSIGNED ) +
            cast(sum(a.noruang/13*(1-abs(sign(a.noruang-13)))) as UNSIGNED ) +
            cast(sum(a.noruang/14*(1-abs(sign(a.noruang-14)))) as UNSIGNED ) as tot_poly
FROM t_admission a,m_ruang b where a.noruang=b.no ".$search." GROUP BY a.noruang ORDER BY a.masukrs DESC";
$qry=mysql_query($sql);
$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$kode=$baris['noruang'];
$nama=$baris['nama']." [".$baris['tot_poly']."]";
$totalpoly=$baris['tot_poly'];
$total[$nama]=$totalpoly;
$v_total=$v_total+$totalpoly;
}

$graph=new PHPGraphLibPie(500,400);
$graph->addData($total); 
$graph->setTitle("TOTAL KUNJUNGAN PASIEN PERRUANG RAWAT INAP [JUMLAH ".$v_total." PASIEN]");
$graph->setLabelTextColor("50,50,50");
$graph->setLegendTextColor("50,50,50");
$graph->createGraph();
?>
<BODY>
test

</BODY>
