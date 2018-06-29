<?php session_start();
include("../../include/connect.php");
include("../../include/function.php");
$kode 		= $_REQUEST['checkbox'];
$jml_kode	= count($_REQUEST['checkbox']);
$ip			= getRealIpAddr();
for($i=0; $i<$jml_kode; $i++):
	mysql_query('insert into tmp_cartorderlab set KODEJASA = '.$kode[$i].', QTY = "1", IP = "'.$ip.'", KET = "-", UNIT = "'.$_SESSION['KDUNIT'].'", NOMR = "'.$_REQUEST['nomr'].'", IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'", KDDOKTER = "'.$_REQUEST['kddokter'].'"');
endfor;
?>