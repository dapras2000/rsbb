<?php session_start(); 
include("../include/connect.php");
if(!empty($_POST['idxDaftar'])){

/* $mulai = $_POST['jamMulai'];
$selesai = $_POST['jamSelesai']; */
$idx_daftar = $_POST['idxDaftar'];
/*$nip = $_SESSION['NIP'];
$petugas = $_POST['petugas']; */
$keterangan = $_POST['keterangan'];
/*$nolab =  $_POST['nolab'];
$shif =  $_POST['SHIF'];*/

$sql = 'SELECT a.IDXORDERLAB, a.KET, a.nilai_normal, a.UNIT, a.KODE, a.IDXDAFTAR, a.HASIL_PERIKSA, a.KETERANGAN,a.TGL_MULAI, a.TGL_SELESAI, a.STATUS, a.KET, b.nama_tindakan, 
    a.TANGGAL 
    FROM t_orderlab a
    JOIN m_tarif2012 b ON (a.KODE = b.kode_tindakan)
    WHERE a.IDXDAFTAR = "'.$idx_daftar.'" AND a.STATUS = 1';

$row = mysql_query($sql)or die(mysql_error());
while ($data = mysql_fetch_array($row)){
	
	if(!empty($_POST["hsl".$data['IDXORDERLAB']])){
		$id_lab = $data['IDXORDERLAB'];
		$hsl = $_POST["hsl".$data['IDXORDERLAB']];
			
		mysql_query("UPDATE t_orderlab SET 
				 HASIL_PERIKSA = '$hsl', 
				 KETERANGAN = '$keterangan'
				 WHERE IDXORDERLAB = $id_lab") or die(mysql_error());	
	}
	
}

?>
<script language="javascript" type="text/javascript" >
	alert("Simpan Data Lab Sukses.");
	window.location="../index.php?link=61";
</script>
<?
}
?>