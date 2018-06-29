<?php
include("../../include/connect.php");
$search = "";
$tgl1 = "";
if(!empty($_POST['tgl_1'])) {
    $tgl1 =$_POST['tgl_1'];
}

if($tgl1 !="") {
    $search = " and t_orderlab.TANGGAL BETWEEN '".$tgl1."'";
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
    $search = " and concat(month(t_orderlab.TANGGAL),year(t_orderlab.TANGGAL)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

$sql="SELECT count(m_lab.kode_jasa) as jml, m_lab.kode_jasa, m_lab.nama_jasa
            FROM m_lab
        INNER JOIN (
          SELECT DISTINCT t_orderlab.IDXDAFTAR, m_lab.group_jasa
          FROM t_orderlab
          INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
          INNER JOIN m_lab m_lab1 ON (m_lab.group_jasa = m_lab1.kode_jasa)
          WHERE t_orderlab.`STATUS` = 1 ".$search."
        ) lb ON (m_lab.kode_jasa = lb.group_jasa)
        GROUP BY m_lab.kode_jasa ORDER BY jml DESC";

$qry=mysql_query($sql);

$i = 0;
$v_total=0;

while($baris=mysql_fetch_assoc($qry)) {
    $xs[$i]['nama_jasa'] = $baris['nama_jasa'];
    $xs[$i]['Jumlah'] = $baris['jml'];
    $v_total=$v_total+$baris['jml'];
    $i++;
}

$x = 0;
while($x < $i) {
    $xs[$x]['%'] = ($xs[$x]['Jumlah'] / $v_total) * 100;
    $x++;
}

$xs[$i]['nama_jasa'] = "Total";
$xs[$i]['Jumlah'] = $v_total;
$xs[$i]['%'] = "100";

//$xs = array_reverse($xs);
$lap_header = "REKAP 10 PEMERIKSAAN TERBANYAK";
$filename = "lab_rekap_10periksa";
include("excelexport.php");
?>
