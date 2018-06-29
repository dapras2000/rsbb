<?php

/* merubah ke associative array */

$jsonfile = "http://eplanning-buk.depkes.go.id/api/eplanning/index.php";

$data= json_decode(file_get_contents($jsonfile), true);
//echo"$k";
//print_r($data);
//$varian=serialize($data);
/* print array object */
//echo $data[0]['kd_satker'];
$h = "localhost";
	$u = "root";
	$p = "webappbuk2013";
	$db = "database";
	
	mysql_connect($h,$u,$p) or die('error : '.mysql_error());
	
	mysql_select_db($db) or die('error : '.mysql_error());
mysql_query("delete from user_eplanning");	
	# akhir dari code koneksi ke db
 for ($i=0; $i<sizeof($data); $i++){
 $sql = mysql_query("insert into user_eplanning(kd_satker2) values('" .$data[$i]['kd_satker']. "')");
 $sql2= mysql_query("update user_eplanning set kodeprop=left(kd_satker2,2) where CHAR_LENGTH(kd_satker2)>=7");
}
include "trigger_eplan.php";
?>
