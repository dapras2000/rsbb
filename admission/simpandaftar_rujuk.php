<?php session_start();
include("../include/connect.php");
include("../include/function.php");

$nomr			= $_POST['nomr'];
$idx			= $_POST['idx'];
$idxadmission 	= $_POST['idxdaftar'];
$dokterpengirim	= $_POST['namadokter'];
$statusbayar	= $_POST['statusbayar'];
$kirimdari		= $_POST['kirimdari'];
$keluargadekat	= $_POST['keluargadekat'];
$penanggungjawab= $_POST['penanggungjawab'];
$idr			= $_POST['idruang'];
$nott			= $_POST['nott'];
$deposit		= $_POST['deposit'];
$masukrs		= $_POST['tgl_masuk'];

$nip 			= $_SESSION['NIP'];
$asal			= $_POST['asal'];
$dokter			= $_POST['dokter'];
$perawat		= $_POST['perawat'];
$icd_masuk		= $_POST['kicd'];
if($_REQUEST['q'] != ''):
$x = explode('--',$_REQUEST['q']);
$icd_masuk		= $x[1];
endif;

if($idr=="" && $nott==""){
	?>
	<script language="javascript">
    alert("Data Ruang Dan Tempat Tidur Belum Dipilih!");
    window.location="?link=17g&nomr=<?=$nomr?>&idx=<?=$idx?>";
    </script>
	<?php
} else {
	if($idr == 15){ # JIKA PILIH KAMAR OK
	mysql_query('delete from tmp_cartbayar where IP = "'.getRealIpAddr().'"');
	$ss 	= mysql_query('select * from t_pendaftaran where NOMR = "'.$nomr.'" and IDXDAFTAR = "'.$idxadmission.'"');
	$dd 	= mysql_fetch_array($ss);
	$kode 	= '02.02.01';
	$tarif	= getTarif($kode);
	$unit  	= 15;	
	$sd		= mysql_query('insert into tmp_cartbayar set KODETARIF = "'.$kode.'", QTY="1", IP = "'.getRealIpAddr().'", poly ="'.$dd['KDPOLY'].'", KDDOKTER = "'.$dokter.'", TARIF ="'.$tarif['tarif'].'", TOTTARIF = "'.$tarif['tarif'].'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'].'", JASA_SARANA = "'.$tarif['jasa_sarana'].'", UNIT = "'.$unit.'", ID = "'.$kode.'"');
	$ff	= mysql_query('insert into t_operasi set nomr = "'.$nomr.'", tanggal = CURDATE(), jammulai = CURTIME(), KDUNIT = "'.$dd['KDPOLY'].'", IDXDAFTAR = "'.$idxadmission.'", TGLORDER = CURDATE(), DRPENGIRIM = "'.$dokter.'", RAJAL = "1", NIP = "'.$_SESSION['NIP'].'", JNSOPERASI = "c"');
	}

	//echo $nomermr;
	//echo $dokterpengirim;

	$ins	="INSERT INTO t_admission (id_admission,nomr,dokterpengirim,statusbayar,kirimdari,keluargadekat,panggungjawab,masukrs,noruang,nott,deposit,icd_masuk,NIP,noruang_asal,nott_asal,kd_rujuk, dokter_penanggungjawab, perawat) VALUES('".$idxadmission."','".$nomr."','".$dokterpengirim."','".$statusbayar."','".$kirimdari."','".$keluargadekat."','".$penanggungjawab."','".$masukrs."','".$idr."','".$nott."','".$deposit."','".$icd_masuk."','".$nip."','".$idr."','".$nott."','".$asal."','".$dokter."','".$perawat."')";
	$query	= mysql_query($ins)or die(mysql_error());
	if($query){
		if($idr != 15):
			mysql_query('insert into t_deposit set NOMR = "'.$nomr.'", IDADMISSION = "'.$idxadmission.'", DEPOSIT = "'.$deposit.'", TANGGAL = now()');
			mysql_query("UPDATE t_pendaftaran SET KELUARPOLY=CURRENT_TIME(), STATUS='2' WHERE IDXDAFTAR='".$idxadmission."'");
			mysql_query("UPDATE t_orderadmission SET STATUS='1' WHERE IDXDAFTAR = '".$idxadmission."'")or die("UPDATE ORDER ADMISSION ERROR!");
		endif;
		?>
		<script language="javascript">
			alert("Simpan Data Sukses!");
			window.location="?link=17f";
		</script>
	<?	
	} 
}
?>

