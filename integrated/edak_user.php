<?php

/* merubah ke associative array */

$jsonfile = "URL";

$data= json_decode(file_get_contents($jsonfile), true);
//echo"$k";
//print_r($data);
//$varian=serialize($data);
/* print array object */
//echo $data[0]['kd_satker'];
$h = "localhost";
	$u = "username";
	$p = "passwd";
	$db = "database";
	
	mysql_connect($h,$u,$p) or die('error : '.mysql_error());
	
	mysql_select_db($db) or die('error : '.mysql_error());
	
	# akhir dari code koneksi ke db
 for ($i=0; $i<sizeof($data); $i++){
 $sql = mysql_query("insert into [table_name](field_name) values('" .$data[$i]['[send_from_json']. "')");

}
?>
