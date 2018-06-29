<?php
$id_admission = $_REQUEST['indeks'];
$no_ruang = $_REQUEST['no_ruang'];
$nott = $_REQUEST['nott'];

$sql_kondisi = "SELECT * FROM t_admission WHERE noruang='$no_ruang' AND nott='$nott' AND keluarrs IS NULL";
$kondisi = mysql_query($sql_kondisi);
$jmlh_data = mysql_num_rows($kondisi);

if($jmlh_data >= 1){
	echo '<script>alert("Kamar sebelumnya sudah terisi, pilih kamar kosong lainnya.")</script>';
	echo '<script>window.location = "'._BASE_.'index.php?link=129y&indeks='.$id_admission.'&historyback=12"</script>';
}else{
	$sql = "DELETE FROM t_resumepulang WHERE IDADMISSION='".$id_admission."'";
	$sql = "UPDATE t_admission SET keluarrs=NULL, icd_keluar='' WHERE id_admission='".$id_admission."'";
	mysql_query($sql);
	echo '<script>alert("Pasien kembali masuk sukses!");window.location = "'._BASE_.'index.php?link=12";</script>';
}
?>