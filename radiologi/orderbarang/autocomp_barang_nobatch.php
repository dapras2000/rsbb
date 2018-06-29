<?php session_start();

	//autocomp.php

	//Add in our database connector.
	require_once ("../../include/connect.php");
	//And open a database connection.
#	$db = opendatabase();
	$kdbarang = $_GET['kdbarang'];
	$myquery = "SELECT no_batch FROM m_barang 
		WHERE LOWER(no_batch) LIKE LOWER('" . addslashes($_GET['sstring']) . "%')
		and kode_barang = ".$kdbarang."
		ORDER BY no_batch ASC";
	
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div style="background: #CCCCCC; border-style: solid; border-width: 1px; border-color: #000000;">
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" onclick="setvalue_rad_nobatch('<?php echo $userdata['no_batch'];?>')"><?php echo $userdata['no_batch'];?></div><?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}

	
?>