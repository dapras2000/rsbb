<?php
include("../include/connect.php");
include("../include/function.php");
$_error_msg = "";

if(trim($_POST['elm1'])==""){ $_error_msg = $_error_msg." Diagnosa Belum Diisi, ";}
if(strlen($_error_msg)>0){	
	$_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
	?>
	<SCRIPT language="JavaScript">
    	alert("<?=$_error_msg?>");
		window.location="../index.php?link=51&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>&new_kasus=<?=$_POST['new_kasus']?>&icd=<?=$_POST['icd']?>&icd_code=<?=$_POST['icd_code']?>&icdcm=<?=$_POST['icdcm']?>&icd_code2=<?=$_POST['icd_code2']?>&elm1=<?=$_POST['elm1']?>&elm2=<?=$_POST['elm2']?>";
    </script>  
	<?
}else{
	#$ip = getRealIpAddr();
	#$sql_terafi = "SELECT temp_cartobat.IDXDAFTAR, temp_cartobat.NAMAOBAT, temp_cartobat.SEDIAAN, temp_cartobat.ATURANPAKAI, temp_cartobat.JUMLAH FROM temp_cartobat WHERE temp_cartobat.IP = '".$ip."'";
	#$get_terafi = mysql_query($sql_terafi);
	#$theraphie = "";
	#$resep = "";
	#while($dat_terafi = mysql_fetch_array($get_terafi)){
	#	$nm_obat = $dat_terafi['NAMAOBAT'];
	#	$sediaan = $dat_terafi['SEDIAAN'];
	#	$aturan =  $dat_terafi['ATURANPAKAI'];
	#	$jumlah = $dat_terafi['JUMLAH'];
	#	$theraphie = $theraphie."<p>".$nm_obat."<br>".$sediaan."<br>".$aturan."<br>".$jumlah."</p>";		
	#	$resep = $resep."<p>".$nm_obat."<br>".$sediaan."<br>".$aturan."<br>".$jumlah."</p>";		
	#}
	$elm2 = $_POST['elm2'];
	$theraphie = $theraphie."<p>".$elm2."</p>";
	#mysql_query("DELETE FROM temp_cartobat WHERE temp_cartobat.IP = '".$ip."'");
	#$icd 		= $_POST['icd_code'];
    #$icdcm 		= $_POST['icd_code2'];
    $new_kasus 	= $_POST['new_kasus'];
	$new_visit 	= $_POST['new_visit'];
	$idxterapi 	= $_POST['idxterapi'];
	$tekanan_darah	= $_POST['tekanan_darah'];
	$golongan_darah	= $_POST['golongan_darah'];
	$tinggi_badan	= $_POST['tinggi_badan'];
	$berat_badan	= $_POST['berat_badan'];
	
	if(trim($_POST['idxterapi']) != ''){
		#mysql_query('UPDATE t_diagnosadanterapi SET DIAGNOSA="'.$_POST[elm1].'",TERAPI="'.$theraphie.'",ICD_CODE='$icd',KASUS_BL='$new_kasus',ICDCM='$icdcm' WHERE IDXTERAPI='".$_POST['idxterapi']."'");
		mysql_query('UPDATE t_diagnosadanterapi SET DIAGNOSA="'.$_POST[elm1].'",TERAPI="'.$theraphie.'",KASUS_BL='.$new_kasus.',KUNJUNGAN_BL = '.$new_visit.', TEKANAN_DARAH = "'.$tekanan_darah.'", GOLONGAN_DARAH = "'.$golongan_darah.'", TINGGI_BADAN = "'.$tinggi_badan.'", BERAT_BADAN = "'.$berat_badan.'" WHERE IDXTERAPI='.$_POST['idxterapi']);
	}else{
		#mysql_query("INSERT INTO t_diagnosadanterapi (IDXDAFTAR, NOMR, TANGGAL,DIAGNOSA, TERAPI, KDPOLY, KDDOKTER, KDTUJUANRUJUK, NIP, ICD_CODE,KUNJUNGAN_BL, KASUS_BL, ICDCM) VALUES('$_POST[txtIdxDaftar]','$_POST[txtNoMR]','$_POST[txtTglReg]','$_POST[elm1]','".$theraphie."','$_POST[txtKdPoly]','$_POST[txtKdDokter]','KDTUJUANRUJUK','$_POST[txtNip]', '$icd', '$kunjungan', '$new_kasus','$icdcm')");
		mysql_query('INSERT INTO t_diagnosadanterapi (IDXDAFTAr, NOMR, TANGGAL,DIAGNOSA, TERAPI, KDPOLY, KDDOKTER, NIP, KUNJUNGAN_BL, KASUS_BL, TEKANAN_DARAH, GOLONGAN_DARAH, TINGGI_BADAN, BERAT_BADAN) VALUES('.$_POST[txtIdxDaftar].',"'.$_POST[txtNoMR].'","'.$_POST[txtTglReg].'","'.$_POST[elm1].'","'.$theraphie.'",'.$_POST[txtKdPoly].','.$_POST[txtKdDokter].',"'.$_SESSION['NIP'].'",'.$new_visit.', '.$new_kasus.',"'.$tekanan_darah.'","'.$golongan_darah.'","'.$tinggi_badan.'","'.$berat_badan.'");');
	}
	?>	
	<SCRIPT language="JavaScript">
    alert("Data Telah Disimpan.");
	window.location="../index.php?link=51&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>&menu=2";
    </SCRIPT>
	<?
}
?>
