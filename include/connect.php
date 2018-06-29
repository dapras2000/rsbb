<?php 
ini_set('display_errors',0);	
ini_set('memory_limit' , '128M');
$hostname = 'localhost:3356';
$database = 'simrs_product';
$username = 'root';
$password = '';
$connect = mysql_connect($hostname, $username, $password,true,65536) or die(mysql_error()); 
mysql_select_db($database,$connect)or die(mysql_error());
define ('_BASE_','http://'.$_SERVER['HTTP_HOST'].'/simrs050618/');
define ('_POPUPTIME_','50000');

$data=mysql_fetch_array(mysql_query("SELECT * FROM profil"));

$rstitle = $data['rstitle'];
$singrstitl = $data['singrstitl'];
$singhead1 = $data['singhead1'];
$singsurat = $data['singsurat'];
$header1 = $data['header1'];
$header2 = $data['header2'];
$header3 = $data['header3'];
$header4 = $data['header4'];
$KDRS = $data['kdrs'];
$KelasRS = $data['KelasRS'];
$NamaRS = $data['NamaRS'];
$KDTarifINACBG = $data['kdtarifnacbg'];

date_default_timezone_set('Asia/Jakarta');
        $hrini = date('Y-m-d H:i:s');
        $tahunnow = date('Y');
		$harinow = date('Y-m-d');