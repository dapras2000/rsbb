<?php
include '../include/connect.php';
$q = strtolower($_GET["q"]);
if (!$q) return;
	// Replace "TABLE_NAME" below with the table you'd like to extract data from
	$data = mysql_query( "SELECT KODE,KETERANGAN FROM icd_cm where KODE like '%$q%'" )or die( mysql_error() );
	// Replace "COLUMN_ONE" below with the column you'd like to search through
	// In between the if/then statement, you may present a string of text
	// you'd like to appear in the textbox.
	while( $row = mysql_fetch_array( $data )){
		echo $row['KODE']."--".$row['KETERANGAN']."\n";
	
}

?>