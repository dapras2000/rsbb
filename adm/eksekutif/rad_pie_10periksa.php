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
	$search = "AND t_radiologi.TGLORDER BETWEEN '".$tgl1."'";
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
	$search = " AND concat(month(t_radiologi.TGLORDER),year(t_radiologi.TGLORDER)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

include("../../include/connect.php");
$sql="SELECT count(m_radiologi.kd_rad) as jml, m_radiologi.kd_rad, m_radiologi.nama_rad
            FROM m_radiologi
        INNER JOIN (
          SELECT DISTINCT t_radiologi.IDXDAFTAR, m_radiologi.gr_rad
          FROM t_radiologi
          INNER JOIN m_radiologi ON (t_radiologi.JENISPHOTO = m_radiologi.kd_rad)
          INNER JOIN m_radiologi m_rad1 ON (m_radiologi.gr_rad = m_rad1.kd_rad)
          where NO_FILM is not null ".$search."
        ) rd ON (m_radiologi.kd_rad = rd.gr_rad)
        GROUP BY m_radiologi.kd_rad ORDER BY jml DESC LIMIT 0,10";
$qry=mysql_query($sql);

$v_total=0;
while($baris=mysql_fetch_assoc($qry))
{
$nama=$baris['nama_rad']." [".$baris['jml']."]";
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
