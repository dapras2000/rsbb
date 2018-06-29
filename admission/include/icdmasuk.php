<?php
include('../../include/connect.php');
$q = strtolower($_GET["q"]);
if (!$q) return;

// Replace "TABLE_NAME" below with the table you'd like to extract data from
$data = mysql_query( "SELECT * FROM icd" )
or die( mysql_error() );

// Replace "COLUMN_ONE" below with the column you'd like to search through
// In between the if/then statement, you may present a string of text
// you'd like to appear in the textbox.
while( $row = mysql_fetch_array( $data )){
	if ( strpos( strtolower( $row['jenis_penyakit'] ), $q ) !== false ) {
		echo $row['jenis_penyakit']."--".$row['icd_code']."\n";
	}
}

?>