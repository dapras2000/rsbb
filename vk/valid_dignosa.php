<?php session_start();
include("../include/connect.php");
include("../include/function.php");
$_error_msg = "";
$ip = getRealIpAddr();
$elm2 = $_POST['elm2'];
$new_kasus 	= $_REQUEST['new_kasus'];
$kunjungan 	= $_REQUEST['new_visit'];
if($_POST['elm1']=="") $_error_msg = $_error_msg." Diagnosa Belum Diisi, ";
//if($_POST['icd_code']=="") $_error_msg = $_error_msg." ICD Code Belum Diiisi, ";
if(strlen($_error_msg)>0){	
  $_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
?>

<SCRIPT language="JavaScript">
alert("<?=$_error_msg?>");
window.location="../index.php?link=51&menu=12&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>&new_kasus=<?=$_POST['new_kasus']?>&icd=<?=$_POST['icd']?>&icd_code=<?=$_POST['icd_code']?>&icdcm=<?=$_POST['icdcm']?>&icd_code2=<?=$_POST['icd_code2']?>&elm1=<?=$_POST['elm1']?>&elm2=<?=$_POST['elm2']?>";
</script>
  
<?
}else{	
$s = mysql_query('select * from t_diagnosadanterapi where IDXDAFTAR = "'.$_REQUEST['txtIdxDaftar'].'"');
if(mysql_num_rows($s) > 0){
	mysql_query("UPDATE t_diagnosadanterapi set TANGGAL = '".$_POST['txtTglReg']."',
																	  DIAGNOSA = '".$_POST['elm1']."',
																	  TERAPI = '".$_REQUEST['elm2']."',
																	  KDDOKTER = '".$_POST['txtKdDokter']."',
																	  NIP = '".$_SESSION[NIP]."',
																	  KUNJUNGAN_BL = '".$kunjungan."',
																	  KASUS_BL = '".$new_kasus."' where IDXDAFTAR = '".$_REQUEST['txtIdxDaftar']."'");
}else{
	mysql_query("INSERT INTO t_diagnosadanterapi (IDXDAFTAR, NOMR, TANGGAL,DIAGNOSA, TERAPI, KDPOLY, KDDOKTER, NIP, KUNJUNGAN_BL, KASUS_BL)
												  VALUES('".$_POST['txtIdxDaftar']."','".$_POST['txtNoMR']."','".$_POST['txtTglReg']."','".$_POST['elm1']."','".$_REQUEST['elm2']."','".$_POST['txtKdPoly']."','".$_POST['txtKdDokter']."','".$_SESSION['NIP']."','".$kunjungan."', '".$new_kasus."')");
}
?>	

<SCRIPT language="JavaScript">
alert("Data Telah Disimpan.");
window.location="../index.php?link=51&menu=12&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>";
</SCRIPT>
	
<?		
	
}
?>
