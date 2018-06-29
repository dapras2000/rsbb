<?php
include("../../include/connect.php");

$search = "";
$tgl1 = "";
if(!empty($_POST['tgl_1'])) {
    $tgl1 =$_POST['tgl_1'];
}

if($tgl1 !="") {
    $search = " and a.TANGGAL BETWEEN '".$tgl1."'";
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
    $search = " and concat(month(a.TANGGAL),year(a.TANGGAL)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

$sql="SELECT a.ICD_CODE,b.jenis_penyakit, COUNT(a.ICD_CODE) AS jumlah FROM t_diagnosadanterapi a,icd b WHERE a.icd_code=b.icd_code ".$search." GROUP BY a.ICD_CODE ORDER BY jumlah DESC";

$qry=mysql_query($sql);

$i = 0;
$v_total=0;

while($baris=mysql_fetch_assoc($qry)) {
    $xs[$i]['Jenis_Penyakit'] = $baris['jenis_penyakit'];
    $xs[$i]['Jumlah'] = $baris['jumlah'];
    $v_total=$v_total+$baris['jumlah'];
    $i++;
}

$x = 0;
while($x < $i) {
    $xs[$x]['%'] = ($xs[$x]['Jumlah'] / $v_total) * 100;
    $x++;
}

$xs[$i]['Jenis_Penyakit'] = "Total";
$xs[$i]['Jumlah'] = $v_total;
$xs[$i]['%'] = "100";

//$xs = array_reverse($xs);
$lap_header = "REKAP 10 PENYAKIT TERBANYAK";
$filename = "rekap_10penyakit";
include("excelexport.php");
?>
