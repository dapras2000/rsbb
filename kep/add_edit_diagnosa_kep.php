<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$t_date=date('d/M/y');

if(($_POST['ID_DOMAIN'] =="0") || ($_POST['ID_DIAGNOSIS'] =="0")) {
 ?>
 <script language="javascript">
	alert("Maaf Input Diagnosa Keperawatan Belum Lengkap");
	window.location="<?php echo _BASE_;?>index.php?link=diagnosa_kep&NOMR=<?=$_POST['nomr']?>&nama=<?=$_POST['nama']?>&idadmission=<?=$_POST['idadmission']?>";
 </script>
 <?
} else {
	$sub_var1 = "";
	foreach($_POST['SUB_VAR1'] as $SUMBER_sub_var1) {
		$sub_var1 = $sub_var1.$SUMBER_sub_var1.",";
	}
	$sub_var1 = substr_replace($sub_var1 ,"",-1);
	$sub_var2 = "";
	foreach($_POST['SUB_VAR2'] as $SUMBER_sub_var2) {
		$sub_var2 = $sub_var2.$SUMBER_sub_var2.",";
	}
	$sub_var2 = substr_replace($sub_var2 ,"",-1);
	$sub_var3 = "";
	foreach($_POST['SUB_VAR3'] as $SUMBER_sub_var3) {
		$sub_var3 = $sub_var3.$SUMBER_sub_var3.",";
	}
	$sub_var3 = substr_replace($sub_var3 ,"",-1);
	$sub_var4 = "";
	foreach($_POST['SUB_VAR4'] as $SUMBER_sub_var4) {
		$sub_var4 = $sub_var4.$SUMBER_sub_var4.",";
	}
	$sub_var4 = substr_replace($sub_var4 ,"",-1);
	if(!isset($_POST['id_diagkep'])) {
		$sqlinsert_pendaftaran = " INSERT INTO t_diagnosakep (nomr, idadmission, id_domain, id_diagnosis, sub_var1, sub_var2, sub_var3, sub_var4, perawat, tgl) VALUES('".trim($_POST['nomr'])."','".trim($_POST['idadmission'])."','".trim($_POST['ID_DOMAIN'])."','".trim($_POST['ID_DIAGNOSIS'])."','".$sub_var1."','".$sub_var2."','".$sub_var3."','".$sub_var4."','".trim($_POST['perawat'])."',now())";
		mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
	 ?>
	 <script language="javascript">
		alert("Penyimpanan Data Sukses ");
		window.location="<?php echo _BASE_;?>index.php?link=diagnosa_kep&NOMR=<?=$_POST['nomr']?>&nama=<?=$_POST['nama']?>&idadmission=<?=$_POST['idadmission']?>";
	 </script>
	 <?
	} else {
		$sqlupdate = "UPDATE t_diagnosakep SET
						  nomr = '".trim($_POST['nomr'])."',
						  idadmission  = '".trim($_POST['idadmission'])."',
						  id_domain  = '".trim($_POST['ID_DOMAIN'])."',
						  id_diagnosis  = '".trim($_POST['ID_DIAGNOSIS'])."', 
						  perawat= '".trim($_POST['perawat'])."',
						  sub_var1  = '".$sub_var1."', 
						  sub_var2  = '".$sub_var2."', 
						  sub_var3  = '".$sub_var3."', 
						  sub_var4  = '".$sub_var4."'
					WHERE id_diagnosakep = '".trim($_POST['id_diagkep'])."' ";
					mysql_query($sqlupdate)or die(mysql_error());
		 ?>
		  <script language="javascript">
			alert("Edit Data Diagnosa Keperawatan Sukses");
			window.location="<?php echo _BASE_; ?>index.php?link=diagnosa_kep&NOMR=<?=$_POST['nomr']?>&nama=<?=$_POST['nama']?>&idadmission=<?=$_POST['idadmission']?>";
		 </script>

		 <?
	}
}
?>