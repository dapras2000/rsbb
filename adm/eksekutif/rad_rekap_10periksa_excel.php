<?php
include("../../include/connect.php");
$search = "";
$tgl1 = "";
if(!empty($_POST['tgl_1'])) {
    $tgl1 =$_POST['tgl_1'];
}

if($tgl1 !="") {
    $search = " and t_radiologi.TGLORDER BETWEEN '".$tgl1."'";
}

$tgl2 = "";
if(!empty($_POST['tgl_2'])) {
    $tgl2 =$_POST['tgl_2'];
}


if($tgl1 !="") {
    if($tgl2 !="") {
        $search = $search." AND '".$tgl2."'";
    }else {
        $search = $search." AND '".$tgl1."'";
    }
}

if($search == "") {
    $search = " and concat(month(t_radiologi.TGLORDER),year(t_radiologi.TGLORDER)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

$sql="SELECT count(m_radiologi.kd_rad) as jml, m_radiologi.kd_rad, m_radiologi.nama_rad
            FROM m_radiologi
        INNER JOIN (
          SELECT DISTINCT t_radiologi.IDXDAFTAR, m_radiologi.gr_rad
          FROM t_radiologi
          INNER JOIN m_radiologi ON (t_radiologi.JENISPHOTO = m_radiologi.kd_rad)
          INNER JOIN m_radiologi m_rad1 ON (m_radiologi.gr_rad = m_rad1.kd_rad)
          where NO_FILM is not null ".$search."
        ) rd ON (m_radiologi.kd_rad = rd.gr_rad)
        GROUP BY m_radiologi.kd_rad ORDER BY jml DESC";

$qry=mysql_query($sql);

$i = 0;
$v_total=0;

while($baris=mysql_fetch_assoc($qry)) {
    $xs[$i]['nama_rad'] = $baris['nama_rad'];
    $xs[$i]['Jumlah'] = $baris['jml'];
    $v_total=$v_total+$baris['jml'];
    $i++;
}

$x = 0;
while($x < $i) {
    $xs[$x]['%'] = ($xs[$x]['Jumlah'] / $v_total) * 100;
    $x++;
}

$xs[$i]['nama_rad'] = "Total";
$xs[$i]['Jumlah'] = $v_total;
$xs[$i]['%'] = "100";

//$xs = array_reverse($xs);
$lap_header = "REKAP 10 PEMERIKSAAN TERBANYAK";
$filename = "rad_rekap_10periksa";
include("excelexport.php");
?>
