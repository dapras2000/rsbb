<?php session_start();
include("../include/connect.php");

$script	= "";
$idadmission 	= $_POST['idadmission'];
$icd_code 	= explode('--',$_POST['icd_code']);
$icd_code2 	= explode('--',$_POST['icd_code2']);
for($i==3;$i<=30;$i++){
	if(isset($_POST['icd_code'.$i])){
		${'icd_code'.$i} = explode('--',$_POST['icd_code'.$i]);
		$script = $script.", ICDKELUAR".$i." = '".${'icd_code'.$i}[0]."'";
	}
}
$icd_9 	= explode('--',$_POST['icd_9']);
$icd_92 	= explode('--',$_POST['icd_92']);
for($j==3;$j<=30;$j++){
	if(isset($_POST['icd_9'.$j])){
		${'icd_9'.$j} = explode('--',$_POST['icd_9'.$j]);
		$script = $script.", ICD_9".$j." = '".${'icd_9'.$j}[0]."'";
	}
}

$sql = "UPDATE t_resumepulang SET ICDKELUAR = '".$icd_code[0]."', NIP = '".$_SESSION['NIP']."', ICDKELUAR2 = '".$icd_code2[0]."', ICD_9 = '".$icd_9[0]."', ICD_92 = '".$icd_92[0]."'".$script." WHERE idadmission = '".$idadmission."'";
$get = mysql_query($sql);
$sql = "UPDATE t_admission SET icd_keluar = '".$icd_code[0]."' WHERE id_admission = '".$idadmission."'";
$get = mysql_query($sql);

?>
<script language="javascript">
window.location="../index.php?link=135&page=<?=$_POST['page']?>&tgl_kunjungan=<?=$_POST['tgl_kunjungan']?>&tgl_kunjungan2=<?=$_POST['tgl_kunjungan2']?>";
</script>