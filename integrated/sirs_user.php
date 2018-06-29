<?php

/* merubah ke associative array */

$jsonfile = "http://sirs.buk.depkes.go.id/get_datars/get_koders.php";

$data= json_decode(file_get_contents($jsonfile), true);
//echo"$k";
//print_r($data);
//$varian=serialize($data);
/* print array object */
//echo $data[0]['kd_satker'];
$h = "localhost";
	$u = "root";
	$p = "";
	$db = "database";
	
	mysql_connect($h,$u,$p) or die('error : '.mysql_error());
	
	mysql_select_db($db) or die('error : '.mysql_error());
#mysql_query("delete from user_sirs");	
	# akhir dari code koneksi ke db
 $diag_id=0;
 for ($i=0; $i<sizeof($data); $i++){
 
 $query=mysql_query("select koders from user_sirs where koders='" .$data[$i]['Koders']. "' ");
 $row=mysql_num_rows($query);
 if ($row < 1){
 $sql = mysql_query("insert into user_sirs(koders,namars,kodeprop) values('" .$data[$i]['Koders']. "','" .$data[$i]['Namars']. "','" .$data[$i]['Kodeprop']. "')");
 $diag_id++
}

}
?>
