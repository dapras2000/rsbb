<?php
include("../include/connect.php");
include("../include/function.php");
$_error_msg = "";

if($_POST['resume_anamnesa']=="") $_error_msg = $_error_msg." Anamnesa Belum Diisi, ";
if(strlen($_error_msg)>0){	
	$_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
	?>
	<SCRIPT language="JavaScript">
    	alert("<?=$_error_msg?>");
		window.location="../index.php?link=51&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>&menu=10&resume_anamnesa=<?=$_POST['resume_anamnesa']?>";
    </script>  
	<?
}else{
	$idxterapi 	= $_POST['idxterapi'];
	
	if(!empty($idxterapi)){
		mysql_query('UPDATE t_diagnosadanterapi SET ANAMNESA="'.$_POST[resume_anamnesa].'" WHERE IDXTERAPI='.$_POST['idxterapi']);
	}else{
		mysql_query('INSERT INTO t_diagnosadanterapi (IDXDAFTAR, NOMR, TANGGAL, ANAMNESA, KDPOLY, KDDOKTER, NIP) VALUES('.$_POST[txtIdxDaftar].',"'.$_POST[txtNoMR].'","'.$_POST[txtTglReg].'","'.$_POST[resume_anamnesa].'",'.$_POST[txtKdPoly].','.$_POST[txtKdDokter].',"'.$_SESSION['NIP'].'");');
	}
	?>	
	<SCRIPT language="JavaScript">
    alert("Data Telah Disimpan.");
	window.location="../index.php?link=51&nomr=<?=$_POST['txtNoMR']?>&idx=<?=$_POST['txtIdxDaftar']?>";
    </SCRIPT>
	<?
}
?>
