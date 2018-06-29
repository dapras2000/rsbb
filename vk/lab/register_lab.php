<?php session_start();
include("../../include/connect.php");
include("../../include/function.php");
$ip	= getRealIpAddr();
if($_SESSION['KDUNIT'] == 10){ 
	#JIKA UNIT VK
	$ranap = check_t_admission($_REQUEST['nomr'],$_REQUEST['idxdaftar']);
	if(!$ranap){
		$rajal	= 0;
	}else{
		$rajal 	= 1;
	}
}
#mysql_query('insert into tmp_cartorderrad set NOMR = "'.$_REQUEST['nomr'].'", IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'", UNIT = "'.$_SESSION['KDUNIT'].'", IP = "'.$ip.'", TGLDAFTAR = "'.date('Y-m-d').'", NIP = "'.$_SESSION['NIP'].'", KDDOKTER = "'.$_REQUEST['kddokter'].'", DIAGNOSA = "'.trim($_REQUEST['diagnosa']).'",CARABAYAR = "'.$_REQUEST['carabayar'].'", RAJAL = "'.$rajal.'"');

mysql_query('insert into tmp_cartorderlab set NOMR = "'.$_REQUEST['nomr'].'", IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'", UNIT = "'.$_SESSION['KDUNIT'].'", IP = "'.$ip.'", TGLDAFTAR = "'.date('Y-m-d').'", NIP = "'.$_SESSION['NIP'].'", KDDOKTER = "'.$_REQUEST['kddokter'].'",CARABAYAR = "'.$_REQUEST['carabayar'].'", RAJAL = "'.$rajal.'"');