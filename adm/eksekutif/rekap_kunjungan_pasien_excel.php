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

$sql_2="select date_format(a.tglreg,'%d/%m/%Y') as tglreg,a.kdpoly,
			cast(sum(a.kdpoly*(1-abs(sign(a.kdpoly-1)))) as UNSIGNED ) as poli_kd1,
			cast(sum(a.kdpoly/2*(1-abs(sign(a.kdpoly-2)))) as UNSIGNED ) as poli_kd2,
			cast(sum(a.kdpoly/3*(1-abs(sign(a.kdpoly-3)))) as UNSIGNED ) as poli_kd3,
			cast(sum(a.kdpoly/4*(1-abs(sign(a.kdpoly-4)))) as UNSIGNED ) as poli_kd4,
			cast(sum(a.kdpoly/5*(1-abs(sign(a.kdpoly-5)))) as UNSIGNED ) as poli_kd5,
			cast(sum(a.kdpoly/6*(1-abs(sign(a.kdpoly-6)))) as UNSIGNED ) as poli_kd6,
			cast(sum(a.kdpoly/7*(1-abs(sign(a.kdpoly-7)))) as UNSIGNED ) as poli_kd7,
			cast(sum(a.kdpoly/8*(1-abs(sign(a.kdpoly-8)))) as UNSIGNED ) as poli_kd8,
			cast(sum(a.kdpoly/9*(1-abs(sign(a.kdpoly-9)))) as UNSIGNED ) as poli_kd9,
			cast(sum(a.kdpoly/10*(1-abs(sign(a.kdpoly-10)))) as UNSIGNED ) as poli_kd10,
			cast(sum(a.kdpoly/11*(1-abs(sign(a.kdpoly-11)))) as UNSIGNED ) as poli_kd11,
                        cast(sum(a.kdpoly/28*(1-abs(sign(a.kdpoly-28)))) as UNSIGNED ) as poli_kd12,
                        cast(sum(a.kdpoly/29*(1-abs(sign(a.kdpoly-29)))) as UNSIGNED ) as poli_kd13,
                        cast(sum(a.kdpoly/30*(1-abs(sign(a.kdpoly-30)))) as UNSIGNED ) as poli_kd14
FROM t_pendaftaran a WHERE 1 ".$search." GROUP BY a.tglreg";

$qry=mysql_query($sql);
$qry_2=mysql_query($sql_2);

$i = 0;
$s = 0;
$v_total=0;

while($baris=mysql_fetch_assoc($qry)) {
    $xs[$i]['Poly'] = $baris['nama'];
    $xs[$i]['Jumlah'] = $baris['tot_poly'];
    $v_total=$v_total+$baris['tot_poly'];
    $i++;
}

$x = 0;
while($x < $i) {
    $xs[$x]['%'] = ($xs[$x]['Jumlah'] / $v_total) * 100;
    $x++;
}

$xs[$i]['Poly'] = "Total";
$xs[$i]['Jumlah'] = $v_total;
$xs[$i]['%'] = "100";

while($baris2=mysql_fetch_assoc($qry_2)) {
    if($s > $i) {
        $xs[$s]['Poly'] = "";
        $xs[$s]['Jumlah'] = "";
        $xs[$s]['%'] = "";
    }
    $xs[$s][' '] = "";
    $xs[$s]['Tanggal'] = $baris2['tglreg'];
    $xs[$s]['Penyakit Dalam'] = $baris2['poli_kd1'];
    $xs[$s]['Kebidanan & Kandungan'] = $baris2['poli_kd2'];
    $xs[$s]['Anak'] = $baris2['poli_kd3'];
    $xs[$s]['Bedah'] = $baris2['poli_kd4'];
    $xs[$s]['Gigi'] = $baris2['poli_kd5'];
    $xs[$s]['Psikiatri'] = $baris2['poli_kd6'];
    $xs[$s]['Neurologi'] = $baris2['poli_kd7'];
    $xs[$s]['Anestesi'] = $baris2['poli_kd8'];
    $xs[$s]['UGD'] = $baris2['poli_kd9'];
    $xs[$s]['VK'] = $baris2['poli_kd10'];
    $xs[$s]['Rujukan'] = $baris2['poli_kd11'];
    $xs[$s]['THT'] = $baris2['poli_kd12'];
    $xs[$s]['Mata'] = $baris2['poli_kd13'];
    $xs[$s]['Paru'] = $baris2['poli_kd14'];
    $xs[$s]['Jumlah_'] = $baris2['poli_kd1'] + $baris2['poli_kd2'] + $baris2['poli_kd3'] +
                        $baris2['poli_kd4'] + $baris2['poli_kd5'] + $baris2['poli_kd6'] +
                        $baris2['poli_kd7'] + $baris2['poli_kd8'] + $baris2['poli_kd9'] +
                        $baris2['poli_kd10'] + $baris2['poli_kd11'] + $baris2['poli_kd12'] +
                        $baris2['poli_kd13'] + $baris2['poli_kd14'];
    $s++;
}

//$xs = array_reverse($xs);
$lap_header = "REKAP KUNJUNGAN PASIEN";
$filename = "rekap_kunjungan_pasien";
include("excelexport.php");
?>
