<?php session_start();
include("../include/connect.php");

$script	= "";
$idxdaftar 	= $_POST['idxdaftar'];
$icd_code 	= explode('--',$_POST['icd_code']);
$icd_code2 	= explode('--',$_POST['icd_code2']);
for($i==3;$i<=30;$i++){
	if(isset($_POST['icd_code'.$i])){
		${'icd_code'.$i} = explode('--',$_POST['icd_code'.$i]);
		$script = $script.", ICD_CODE".$i." = '".${'icd_code'.$i}[0]."'";
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

$sql = "UPDATE t_diagnosadanterapi SET ICD_CODE = '".$icd_code[0]."', DIAGNOSA = '".$_REQUEST['DIAGNOSA']."', NIP = '".$_SESSION['NIP']."', ICD_CODE2 = '".$icd_code2[0]."', ICD_9 = '".$icd_9[0]."', ICD_92 = '".$icd_92[0]."'".$script."
		WHERE IDXDAFTAR = '".$idxdaftar."'";
  		$get = mysql_query($sql);

?>
<script language="javascript">
window.location="../index.php?link=133&page=<?=$_POST['page']?>&tgl_kunjungan=<?=$_POST['tgl_kunjungan']?>&tgl_kunjungan2=<?=$_POST['tgl_kunjungan2']?>&poli=<?=$_POST['poli']?>";
</script>