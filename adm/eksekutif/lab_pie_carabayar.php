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
			cast(sum(a.kdcarabayar*(1-abs(sign(a.kdcarabayar-1)))) as UNSIGNED ) +
			cast(sum(a.kdcarabayar/2*(1-abs(sign(a.kdcarabayar-2)))) as UNSIGNED ) +
			cast(sum(a.kdcarabayar/3*(1-abs(sign(a.kdcarabayar-3)))) as UNSIGNED ) +
			cast(sum(a.kdcarabayar/4*(1-abs(sign(a.kdcarabayar-4)))) as UNSIGNED ) +
			cast(sum(a.kdcarabayar/5*(1-abs(sign(a.kdcarabayar-5)))) as UNSIGNED ) +
                        cast(sum(a.kdcarabayar/6*(1-abs(sign(a.kdcarabayar-6)))) as UNSIGNED )as tot_byr
FROM t_pendaftaran a
inner join m_carabayar b on (a.kdcarabayar=b.kode)
inner join (select distinct idxdaftar from t_orderlab l where `status` = '1') l on (a.idxdaftar = l.idxdaftar)
".$search." GROUP BY a.kdcarabayar";
$qry=mysql_query($sql);

$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$kode=$baris['kdpoly'];
$nama=$baris['nama']." [".$baris['tot_byr']."]";
$totalpoly=$baris['tot_byr'];
$total[$nama]=$totalpoly;
$v_total=$v_total+$totalpoly;
}

$graph=new PHPGraphLibPie(500,400);
$graph->addData($total); 
$graph->setTitle("TOTAL PASIEN LAB BERDASAR CARA BAYAR [JUMLAH ".$v_total." PASIEN]");
$graph->setLabelTextColor("50,50,50");
$graph->setLegendTextColor("50,50,50");
$graph->createGraph();
?>
<BODY>
test
</BODY>