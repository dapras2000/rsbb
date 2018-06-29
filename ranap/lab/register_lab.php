<?php session_start();
include("../../include/connect.php");
include("../../include/function.php");
$ip			= getRealIpAddr();
$rajal		= getGroupUnit($_SESSION['KDUNIT']);
mysql_query('insert into tmp_cartorderlab set NOMR = "'.$_REQUEST['nomr'].'", IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'", UNIT = "'.$_SESSION['KDUNIT'].'", IP = "'.$ip.'", TGLDAFTAR = "'.date('Y-m-d').'", NIP = "'.$_SESSION['NIP'].'", KDDOKTER = "'.$_REQUEST['kddokter'].'", RAJAL = "'.$rajal.'",CARABAYAR="'.$_REQUEST['carabayar'].'"');
?>
<script>
window.location = '<?php echo _BASE_;?>index.php?link=121&id_admission=<?php echo $_REQUEST['idxdaftar'];?>';
</script>