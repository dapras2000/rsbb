<?php 
include("../../include/connect.php");

$x = 0;
$total = 0;

$sql_rad = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad, m_radiologi.nama_rad, 
			 m_tarif.tarif, m_radiologi.kode_tarif
			FROM m_radiologi
			INNER JOIN m_tarif ON (m_radiologi.kode_tarif = m_tarif.kode)
			WHERE m_radiologi.gr_rad <> '-'";
$get_rad = mysql_query($sql_rad);

while($dat_rad = mysql_fetch_array($get_rad)) {

    if(isset($_POST['rad'.$dat_rad['kd_rad']])) {
        $kd_rad = $dat_rad['kd_rad'];
        $kode_tarif = $dat_rad['kode_tarif'];
        $tarifrs = $dat_rad['tarif'];
        $total = $total +  $tarifrs;
        $sql_r = "INSERT INTO t_radiologi_aps (TGLORDER, JENISPHOTO, IDXDAFTAR, NOMR, NIPKIRIM, RAJAL) VALUES('$_POST[txtTglReg]','$kd_rad','$_POST[txtIdxDaftar]','$_POST[txtNoMR]','$_POST[txtNip]','1')";
        mysql_query($sql_r)or die(mysql_error());
        $x = 1;
    }
}

if($x == 1) {
    $psn="Input Data Berhasil";
}else {
    $psn="<p>Anda Belum Mengisi Dengan Item Radiologi Field.</p>";
}
?>
<script language="javascript" >
alert("Data Telah Disimpan.");
window.location="../../index.php?link=r03&idx=<?=$_POST[txtIdxDaftar]?>";
</script>
<?
exit;
?>