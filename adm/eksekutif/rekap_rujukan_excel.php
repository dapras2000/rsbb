<?php
include("../../include/connect.php");
$search = "";
$tgl1 = "";
if(!empty($_POST['tgl_1'])) {
    $tgl1 =$_POST['tgl_1'];
}

if($tgl1 !="") {
    $search = " and a.tglreg BETWEEN '".$tgl1."'";
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
    $search = " and concat(month(a.tglreg),year(a.tglreg)) = concat(month(CURRENT_DATE()),year(CURRENT_DATE())) ";
}

$sql="select date_format(a.tglreg,'%d-%m-%Y') as tglreg,a.kdpoly,b.nama,
			cast(sum(a.kdrujuk*(1-abs(sign(a.kdrujuk-1)))) as UNSIGNED ) +
			cast(sum(a.kdrujuk/2*(1-abs(sign(a.kdrujuk-2)))) as UNSIGNED ) +
			cast(sum(a.kdrujuk/3*(1-abs(sign(a.kdrujuk-3)))) as UNSIGNED ) +
			cast(sum(a.kdrujuk/4*(1-abs(sign(a.kdrujuk-4)))) as UNSIGNED ) as tot_rujuk
FROM t_pendaftaran a,m_rujukan b where a.kdrujuk=b.kode ".$search." GROUP BY a.kdrujuk";

$sql_2="select date_format(a.tglreg,'%d-%m-%Y') as tglreg,a.kdpoly,
			cast(sum(a.kdrujuk*(1-abs(sign(a.kdrujuk-1)))) as UNSIGNED ) as rujuk_kd1,
			cast(sum(a.kdrujuk/2*(1-abs(sign(a.kdrujuk-2)))) as UNSIGNED ) as rujuk_kd2,
			cast(sum(a.kdrujuk/3*(1-abs(sign(a.kdrujuk-3)))) as UNSIGNED ) as rujuk_kd3,
			cast(sum(a.kdrujuk/4*(1-abs(sign(a.kdrujuk-4)))) as UNSIGNED ) as rujuk_kd4
FROM t_pendaftaran a Where 1 ".$search." GROUP BY a.tglreg";

$qry=mysql_query($sql);
$qry_2=mysql_query($sql_2);

$i = 0;
$s = 0;
$v_total=0;

while($baris=mysql_fetch_assoc($qry)) {
    $xs[$i]['Rujukan'] = $baris['nama'];
    $xs[$i]['Jumlah'] = $baris['tot_rujuk'];
    $v_total=$v_total+$baris['tot_rujuk'];
    $i++;
}

$x = 0;
while($x < $i) {
    $xs[$x]['%'] = ($xs[$x]['Jumlah'] / $v_total) * 100;
    $x++;
}

$xs[$i]['Rujukan'] = "Total";
$xs[$i]['Jumlah'] = $v_total;
$xs[$i]['%'] = "100";

while($baris2=mysql_fetch_assoc($qry_2)) {
    if($s > $i) {
        $xs[$s]['Rujukan'] = "";
        $xs[$s]['Jumlah'] = "";
        $xs[$s]['%'] = "";
    }
    $xs[$s][' '] = "";
    $xs[$s]['Tanggal'] = $baris2['tglreg'];
    $xs[$s]['Datang Sendiri'] = $baris2['rujuk_kd1'];
    $xs[$s]['Puskesmas'] = $baris2['rujuk_kd2'];
    $xs[$s]['Rumah Sakit'] = $baris2['rujuk_kd3'];
    $xs[$s]['Lain-lain'] = $baris2['rujuk_kd4'];
    $xs[$s]['Jumlah_'] = $baris2['rujuk_kd1'] + $baris2['rujuk_kd2'] + $baris2['rujuk_kd3'] + $baris2['rujuk_kd4'];
    $s++;
}

//$xs = array_reverse($xs);
$lap_header = "REKAP RUJUKAN";
$filename = "rekap_rujukan";
include("excelexport.php");
?>
