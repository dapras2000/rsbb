<?php
include("../include/connect.php");
include("../include/function.php");
$_error_msg = "";

if($_POST['elm1']=="") $_error_msg = $_error_msg." Diagnosa Belum Diisi, ";
//if($_POST['icd_code']=="") $_error_msg = $_error_msg." ICD Code Belum Diiisi, ";

if(strlen($_error_msg)>0){	
	$_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
	?>
	<SCRIPT language="JavaScript">
    alert("<?=$_error_msg?>");
    window.location="../index.php?link=51&menu=2&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>&new_kasus=<?=$_POST['new_kasus']?>&icd=<?=$_POST['icd']?>&icd_code=<?=$_POST['icd_code']?>&icdcm=<?=$_POST['icdcm']?>&icd_code2=<?=$_POST['icd_code2']?>&elm1=<?=$_POST['elm1']?>&elm2=<?=$_POST['elm2']?>";
    </script>  
	<?
}else{
	$ip = getRealIpAddr();
	$elm2 = $_POST['elm2'];
	$sql_terafi = "SELECT temp_cartobat.IDXDAFTAR, temp_cartobat.NAMAOBAT, temp_cartobat.SEDIAAN, temp_cartobat.ATURANPAKAI, temp_cartobat.JUMLAH FROM temp_cartobat WHERE temp_cartobat.IP = '".$ip."'";
	$get_terafi = mysql_query($sql_terafi);
	$theraphie = "";
	$resep = "";
	while($dat_terafi = mysql_fetch_array($get_terafi)){
		$nm_obat = $dat_terafi['NAMAOBAT'];
		$sediaan = $dat_terafi['SEDIAAN'];
		$aturan =  $dat_terafi['ATURANPAKAI'];
		$jumlah = $dat_terafi['JUMLAH'];
		$theraphie = $theraphie."<p>".$nm_obat."<br>".$sediaan."<br>".$aturan."<br>".$jumlah."</p>";		
		$resep = $resep."<p>".$nm_obat."<br>".$sediaan."<br>".$aturan."<br>".$jumlah."</p>";		
	}
	$theraphie = $theraphie."<p>".$elm2."</p>";

	mysql_query("DELETE FROM temp_cartobat WHERE temp_cartobat.IP = '".$ip."'");

    $new_kasus 	= $_POST['new_kasus'];
	$icd 		= $_POST['icd_code'];
    $icdcm 		= $_POST['icd_code2'];
	$idxterapi 	= $_POST['idxterapi'];
	
	if(!empty($idxterapi)){
		mysql_query("UPDATE t_diagnosadanterapi SET DIAGNOSA='$_POST[elm1]',TERAPI='".$theraphie."',ICD_CODE='$icd',KASUS_BL='$new_kasus',ICDCM='$icdcm' WHERE IDXTERAPI='".$_POST['idxterapi']."'");
	}else{
		mysql_query("INSERT INTO t_diagnosadanterapi (IDXDAFTAR, NOMR, TANGGAL,DIAGNOSA, TERAPI, KDPOLY, KDDOKTER, KDTUJUANRUJUK, NIP, ICD_CODE,KUNJUNGAN_BL, KASUS_BL, ICDCM) VALUES('$_POST[txtIdxDaftar]','$_POST[txtNoMR]','$_POST[txtTglReg]','$_POST[elm1]','".$theraphie."','$_POST[txtKdPoly]','$_POST[txtKdDokter]','KDTUJUANRUJUK','$_POST[txtNip]', '$icd', '$kunjungan', '$new_kasus','$icdcm')");
	}
	?>	
	<SCRIPT language="JavaScript">
    alert("Data Telah Disimpan.");
    window.location="../index.php?link=51&menu=2&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>";
    </SCRIPT>
	<?
}
?>
