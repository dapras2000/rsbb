<?php session_start();
include("../../include/connect.php");
include("../../include/function.php");
$ip	= getRealIpAddr();
mysql_query('insert into tmp_cartorderlab set NOMR = "'.$_REQUEST['nomr'].'", IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'", UNIT = "'.$_SESSION['KDUNIT'].'", IP = "'.$ip.'", TGLDAFTAR = "'.date('Y-m-d').'", NIP = "'.$_SESSION['NIP'].'", KDDOKTER = "'.$_REQUEST['kddokter'].'"');