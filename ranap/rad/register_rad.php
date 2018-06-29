<?php session_start();
include("../../include/connect.php");
include("../../include/function.php");
$ip			= getRealIpAddr();
$rajal		= getGroupUnit($_SESSION['KDUNIT']);

mysql_query('insert into tmp_cartorderrad set NOMR = "'.$_REQUEST['nomr'].'", IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'", UNIT = "'.$_SESSION['KDUNIT'].'", IP = "'.$ip.'", TGLDAFTAR = "'.date('Y-m-d').'", NIP = "'.$_SESSION['NIP'].'", KDDOKTER = "'.$_REQUEST['kddokter'].'", DIAGNOSA = "'.trim($_REQUEST['diagnosa']).'",CARABAYAR = "'.$_REQUEST['carabayar'].'", RAJAL = "'.$rajal.'"');
?>
<script>
window.location = '<?php echo _BASE_;?>index.php?link=121&id_admission=<?php echo $_REQUEST['idxdaftar'];?>';
</script>