<?php
/*include('../../include/connect.php');
$q = strtolower($_GET["q"]);
if (!$q) return;

// Replace "TABLE_NAME" below with the table you'd like to extract data from
$data = mysql_query( "SELECT * FROM m_pantri" )
or die( mysql_error() );

// Replace "COLUMN_ONE" below with the column you'd like to search through
// In between the if/then statement, you may present a string of text
// you'd like to appear in the textbox.
while( $row = mysql_fetch_array( $data )){
	if ( strpos( strtolower( $row['nama_makanan'] ), $q ) !== false ) {
		echo $row['nama_makanan']."\n";
	}
}*/

include '../../include/connect.php';
	$myquery = "SELECT * FROM m_pantri WHERE LOWER(nama_makanan) LIKE LOWER('" . addslashes($_GET['sstring']) . "%')ORDER BY nama_makanan ASC";
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div style="background: #CCCCCC; border-style: solid; border-width: 1px; border-color: #000000; width:500px;">
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" onclick="setvalue_pantri ('<?php echo $userdata['nama_makanan'];?>','<?php echo $userdata['satuan']; ?>','<?php echo $userdata['harga']; ?>')"><?php echo $userdata['nama_makanan']; ?>&nbsp;(<?php echo $userdata['spesifikasi']; ?>)</div>
				
				<?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}

?>