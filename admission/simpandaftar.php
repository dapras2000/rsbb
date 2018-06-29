<?php

$nomr			= $_POST['nomr'];
$idxadmission 	= $_POST['idxdaftar'];
$dokterpengirim	= $_POST['namadokter'];
$statusbayar	= $_POST['statusbayar'];
$kirimdari		= $_POST['kirimdari'];
$keluargadekat	= $_POST['keluargadekat'];
$penanggungjawab= $_POST['penanggungjawab'];
$idr			= $_POST['idruang'];
$nott			= $_POST['nott'];
$deposit		= $_POST['deposit'];
$icd_masuk		= $_POST['kicd'];
$nip 			= $_SESSION['NIP'];
$asal			= $_POST['asal'];
$dokter			= $_POST['dokter'];
$perawat			= $_POST['perawat'];
$tgl_masuk		= $_POST['tgl_masuk'];
$idxorder		= $_REQUEST['idxorder'];


$icd_masuk		= $_POST['kicd'];
if($_REQUEST['q'] != ''):
$x = explode('--',$_REQUEST['q']);
$icd_masuk		= $x[1];
endif;

# CHECK BILLING DI RAJAL
$ip		= getRealIpAddr();
/*
$rajal	= check_t_bayarrajal($_REQUEST['nomr'],$_REQUEST['idxdaftar']);
if($rajal){
	if($rajal['STATUS'] != 'LUNAS'){ # Jika Blum lunas
		?>
        <script language="javascript">
			alert("Billing Rawat Jalan Belum Diselsaikan!");
			window.location="?link=17&no=<?=$idxorder?>";
		</script>
        <?php
	}
}
*/
if($idr=="" && $nott==""){
	?>
		<script language="javascript">
			alert("Data Ruang Dan Tempat Tidur Belum Dipilih!");
			window.location="?link=17&no=<?=$idxorder?>";
		</script>
	<?	
}
$ins="INSERT INTO t_admission (id_admission,nomr,dokterpengirim,statusbayar,kirimdari,keluargadekat,panggungjawab,masukrs,noruang,nott,deposit,icd_masuk,NIP,noruang_asal,nott_asal,kd_rujuk, dokter_penanggungjawab, perawat) VALUES('".$idxadmission."','".$nomr."','".$dokterpengirim."','".$statusbayar."','".$kirimdari."','".$keluargadekat."','".$penanggungjawab."','".$tgl_masuk."','".$idr."','".$nott."','".$deposit."','".$icd_masuk."','".$nip."','".$idr."','".$nott."','".$asal."','". $dokter."','". $perawat."')";
$query = mysql_query($ins)or die(mysql_error());

if($query){
	mysql_query("UPDATE t_orderadmission SET STATUS='1' WHERE IDXDAFTAR = '".$idxadmission."'")or die("UPDATE 		ORDER ADMISSION ERROR!");
	
	mysql_query('insert into t_deposit set NOMR = "'.$nomr.'", IDADMISSION = "'.$idxadmission.'", DEPOSIT = "'.$deposit.'", TANGGAL = now()');
	?>
	<script language="javascript">
    alert("Simpan Data Sukses!");
    window.location="?link=17a";
    </script>
<?	
} 
?>

