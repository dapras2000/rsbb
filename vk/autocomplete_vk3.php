<?php
include '../include/connect.php';
$q = strtolower($_GET["q"]);
if (!$q) return;
	// Replace "TABLE_NAME" below with the table you'd like to extract data from
	$data = mysql_query( "SELECT kode, keterangan FROM icd_cm where kode like '%$q'")or die( mysql_error() );
	// Replace "COLUMN_ONE" below with the column you'd like to search through
	// In between the if/then statement, you may present a string of text
	// you'd like to appear in the textbox.
	while( $row = mysql_fetch_array( $data )){
	if ( strpos( strtolower( $row['kode'] ), $q ) !== false ) {
		echo $row['kode']."--".$row['keterangan']."\n";
	}
}

?>