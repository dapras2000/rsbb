<?php 
include("../include/connect.php");
include("../include/function.php");
if(empty($_POST['tgl_lahir']) || empty($_POST['jam_lahir'])){
	?>
		<script language="javascript" type="text/javascript" >
			alert("Isian Tidak Lengkap.");
			window.location="<?php echo _BASE_;?>index.php?link=<?=$_POST['link']?>&nomr=<?=$_POST['nomr']?>&menu=<?=$_POST['menu']?>";
        </script>
	<?	
}else{		
	$lahir = $_POST['lahir'];
	$idxdaftar = $_POST['idxdaftar'];
	$nomr = $_POST['nomr'];
	$nip = $_POST['NIP'];
	$kdunit = $_POST['KDUNIT'];
	$tanggal = $_POST['tgl_lahir']." ".$_POST['jam_lahir'];
	$nama = $_POST['nama'];
	$no_surat_lahir = $_POST['no_surat_lahir'];
	$anus = $_POST['anus'];
	$cacad = $_POST['cacad'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$paritas = $_POST['paritas'];
	$berat_badan = $_POST['berat_badan'];
	$panjang_badan = $_POST['panjang_badan'];
	$nilai_apgar = $_POST['nilai_apgar'];
	$nilai_apgar_2 = $_POST['nilai_apgar_2'];
			
	$penolong = $_POST['penolong'];
	$asisten = $_POST['asisten'];
	$jns_persalinan = $_POST['jns_persalinan'];
	$penyulit = $_POST['penyulit'];
	$icd = $_POST['icd_code'];
	$diagnosa = $_POST['diagnosa'];

	if(!empty($_POST['idxreg_partus'])){
		@mysql_query("DELETE FROM t_reg_partus WHERE idxreg_partus = ".$_POST['idxreg_partus']);
	}	
	if($lahir=="1"){		
		$sql = "INSERT INTO t_reg_partus (lahir, idxdaftar, nomr, tanggal, nama,no_surat_lahir, anus, cacad,jenis_kelamin, paritas, berat_badan, panjang_badan,nilai_apgar, nilai_apgar_2, penolong,asisten, jns_persalinan, penyulit, KDUNIT, NIP, kode_icd, diagnosa) VALUES ($lahir, $idxdaftar, '$nomr', '$tanggal', '$nama', '$no_surat_lahir','$anus', '$cacad', '$jenis_kelamin', '$paritas', '$berat_badan','$panjang_badan', '$nilai_apgar', '$nilai_apgar_2', '$penolong', '$asisten', '$jns_persalinan','$penyulit', '$kdunit', '$nip', '$icd', '$diagnosa')";
	}else{
		$sql = "INSERT INTO t_reg_partus (lahir, idxdaftar, nomr, tanggal, no_surat_mati,jenis_kelamin, penolong, asisten, jns_persalinan,penyulit, KDUNIT, NIP, kode_icd, diagnosa) VALUES ($lahir, $idxdaftar, '$nomr', '$tanggal', '$no_surat_mati','$jenis_kelamin', '$penolong', '$asisten', '$jns_persalinan', '$penyulit', '$kdunit', '$nip', '$icd', '$diagnosa')";
	}
	mysql_query($sql) or die(mysql_error());
	?>
	<script language="javascript" type="text/javascript" >
		window.location="<?php echo _BASE_;?>index.php?link=<?=$_POST['link']?>&nomr=<?=$_POST['nomr']?>&menu=<?=$_POST['menu']?>&idx=<?=$idxdaftar?>";
	</script>
<? 
} 
?>
