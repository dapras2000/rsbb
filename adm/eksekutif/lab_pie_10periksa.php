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
	$search = "AND t_orderlab.TANGGAL BETWEEN '".$tgl1."'";
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
	$search = " AND concat(month(t_orderlab.TANGGAL),year(t_orderlab.TANGGAL)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

include("../../include/connect.php");
$sql="SELECT count(m_lab.kode_jasa) as jml, m_lab.kode_jasa, m_lab.nama_jasa
            FROM m_lab
        INNER JOIN (
          SELECT DISTINCT t_orderlab.IDXDAFTAR, m_lab.group_jasa
          FROM t_orderlab
          INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
          INNER JOIN m_lab m_lab1 ON (m_lab.group_jasa = m_lab1.kode_jasa)
          WHERE t_orderlab.`STATUS` = 1 ".$search."
        ) lb ON (m_lab.kode_jasa = lb.group_jasa)
        GROUP BY m_lab.kode_jasa ORDER BY jml DESC LIMIT 0,10";
$qry=mysql_query($sql);

$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$nama=$baris['nama_jasa']." [".$baris['jml']."]";
$totalpoly=$baris['jml'];
$total[$nama]=$totalpoly;
$v_total=$v_total+$totalpoly;
}

$graph=new PHPGraphLibPie(500,400);
$graph->addData($total); 
$graph->setTitle("TOTAL SEPULUH (10) PEMERIKSAAN TERBANYAK [JUMLAH ".$v_total." PASIEN]");
$graph->setLabelTextColor("50,50,50");
$graph->setLegendTextColor("50,50,50");
$graph->createGraph();
?>
