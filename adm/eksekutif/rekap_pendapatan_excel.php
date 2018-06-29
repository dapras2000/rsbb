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

$sql="SELECT a.TANGGAL,
cast(sum(a.TARIFRS*a.kdpoly*(1-abs(sign(a.kdpoly-1)))) as UNSIGNED ) as poli_kd1,
cast(sum(a.TARIFRS*a.kdpoly/2*(1-abs(sign(a.kdpoly-2)))) as UNSIGNED ) as poli_kd2,
cast(sum(a.TARIFRS*a.kdpoly/3*(1-abs(sign(a.kdpoly-3)))) as UNSIGNED ) as poli_kd3,
cast(sum(a.TARIFRS*a.kdpoly/4*(1-abs(sign(a.kdpoly-4)))) as UNSIGNED ) as poli_kd4,
cast(sum(a.TARIFRS*a.kdpoly/5*(1-abs(sign(a.kdpoly-5)))) as UNSIGNED ) as poli_kd5,
cast(sum(a.TARIFRS*a.kdpoly/6*(1-abs(sign(a.kdpoly-6)))) as UNSIGNED ) as poli_kd6,
cast(sum(a.TARIFRS*a.kdpoly/7*(1-abs(sign(a.kdpoly-7)))) as UNSIGNED ) as poli_kd7,
cast(sum(a.TARIFRS*a.kdpoly/8*(1-abs(sign(a.kdpoly-8)))) as UNSIGNED ) as poli_kd8,
cast(sum(a.TARIFRS*a.kdpoly/9*(1-abs(sign(a.kdpoly-9)))) as UNSIGNED ) as poli_kd9,
cast(sum(a.TARIFRS*a.kdpoly/10*(1-abs(sign(a.kdpoly-10)))) as UNSIGNED ) as poli_kd10,
cast(sum(a.TARIFRS*a.kdpoly/11*(1-abs(sign(a.kdpoly-11)))) as UNSIGNED ) as poli_kd11,
cast(sum(a.TARIFRS*a.kdpoly/28*(1-abs(sign(a.kdpoly-28)))) as UNSIGNED ) as poli_kd12,
cast(sum(a.TARIFRS*a.kdpoly/29*(1-abs(sign(a.kdpoly-29)))) as UNSIGNED ) as poli_kd13,
cast(sum(a.TARIFRS*a.kdpoly/30*(1-abs(sign(a.kdpoly-30)))) as UNSIGNED ) as poli_kd14
FROM t_billrajal a WHERE 1 ".$search." and a.kdpoly is not null group by a.TANGGAL";

$qry=mysql_query($sql);

$i = 0;
$v_total=0;

$v_total_dalam=0;
$v_total_kb=0;
$v_total_anak=0;
$v_total_bedah=0;
$v_total_gigi=0;
$v_total_psikiatri=0;
$v_total_neurologi=0;
$v_total_anestesi=0;
$v_total_ugd=0;
$v_total_vk=0;
$v_total_tht=0;
$v_total_mata=0;
$v_total_paru=0;
$v_total_rujukan=0;
$v_total_jumlah=0;

while($baris=mysql_fetch_assoc($qry)) {
    $xs[$i]['Tanggal'] = $baris['TANGGAL'];
    $xs[$i]['DALAM']=$baris['poli_kd1'];
    $xs[$i]['KB dan KD']=$baris['poli_kd2'];
    $xs[$i]['ANAK']=$baris['poli_kd3'];
    $xs[$i]['BEDAH']=$baris['poli_kd4'];
    $xs[$i]['GIGI']=$baris['poli_kd5'];
    $xs[$i]['PSIKIATRI']=$baris['poli_kd6'];
    $xs[$i]['NEUROLOGI']=$baris['poli_kd7'];
    $xs[$i]['ANESTESI']=$baris['poli_kd8'];
    $xs[$i]['UGD']=$baris['poli_kd9'];
    $xs[$i]['VK']=$baris['poli_kd10'];
    $xs[$i]['THT']=$baris['poli_kd12'];
    $xs[$i]['MATA']=$baris['poli_kd13'];
    $xs[$i]['PARU']=$baris['poli_kd14'];
    $xs[$i]['RUJUKAN']=$baris['poli_kd11'];

    $xs[$i]['Jumlah']=$baris['poli_kd1'] + $baris['poli_kd2'] + $baris['poli_kd3'] +
            $baris['poli_kd4'] + $baris['poli_kd5'] + $baris['poli_kd6'] +
            $baris['poli_kd7'] + $baris['poli_kd8'] + $baris['poli_kd9'] +
            $baris['poli_kd10'] + $baris['poli_kd11'] + $baris['poli_kd12'] +
            $baris['poli_kd13'] + $baris['poli_kd14'];

    $v_total_dalam=$v_total_dalam + $baris['poli_kd1'];
    $v_total_kb=$v_total_kb + $baris['poli_kd2'];
    $v_total_anak=$v_total_anak + $baris['poli_kd3'];
    $v_total_bedah=$v_total_bedah + $baris['poli_kd4'];
    $v_total_gigi=$v_total_gigi + $baris['poli_kd5'];
    $v_total_psikiatri=$v_total_psikiatri +$baris['poli_kd6'];
    $v_total_neurologi=$v_total_neurologi + $baris['poli_kd7'];
    $v_total_anestesi=$v_total_anestesi + $baris['poli_kd8'];
    $v_total_ugd=$v_total_ugd + $baris['poli_kd9'];
    $v_total_vk=$v_total_vk + $baris['poli_kd10'];
    $v_total_tht=$v_total_tht + $baris['poli_kd12'];
    $v_total_mata=$v_total_mata + $baris['poli_kd13'];
    $v_total_paru=$v_total_paru + $baris['poli_kd14'];
    $v_total_rujukan=$v_total_rujukan + $baris['poli_kd11'];
    $v_total_jumlah=$v_total_jumlah + $baris['poli_kd1'] + $baris['poli_kd2'] + $baris['poli_kd3'] +
            $baris['poli_kd4'] + $baris['poli_kd5'] + $baris['poli_kd6'] +
            $baris['poli_kd7'] + $baris['poli_kd8'] + $baris['poli_kd9'] +
            $baris['poli_kd10'] + $baris['poli_kd11'] + $baris['poli_kd12'] +
            $baris['poli_kd13'] + $baris['poli_kd14'];
    $i++;
}

$xs[$i]['Tanggal'] = "Total";
$xs[$i]['DALAM']=$v_total_dalam;
$xs[$i]['KB dan KD']=$v_total_kb;
$xs[$i]['ANAK']=$v_total_anak;
$xs[$i]['BEDAH']=$v_total_bedah;
$xs[$i]['GIGI']=$v_total_gigi;
$xs[$i]['PSIKIATRI']=$v_total_psikiatri;
$xs[$i]['NEUROLOGI']=$v_total_neurologi;
$xs[$i]['ANESTESI']=$v_total_anestesi;
$xs[$i]['UGD']=$v_total_ugd;
$xs[$i]['VK']=$v_total_vk;
$xs[$i]['THT']=$v_total_tht;
$xs[$i]['MATA']=$v_total_mata;
$xs[$i]['PARU']=$v_total_paru;
$xs[$i]['RUJUKAN']=$v_total_rujukan;
$xs[$i]['Jumlah']=$v_total_jumlah;

//$xs = array_reverse($xs);
$lap_header = "REKAP PENDAPATAN";
$filename = "rekap_pendapatan";
include("excelexport.php");
?>
