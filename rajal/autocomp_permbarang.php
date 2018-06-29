<?php

	//autocomp.php

	//Add in our database connector.
	include("../include/connect.php");
	if(!empty($_GET['grp'])){
		$myquery = "SELECT DISTINCT(nama_barang),kode_barang FROM m_barang WHERE LOWER(nama_barang) LIKE LOWER('" . addslashes($_GET['sstring']) . "%') AND group_barang = '".$_GET['grp']."' ORDER BY nama_barang ASC";
	}else{
		$myquery = "SELECT DISTINCT(nama_barang),kode_barang FROM m_barang WHERE LOWER(nama_barang) LIKE LOWER('" . addslashes($_GET['sstring']) . "%') ORDER BY nama_barang ASC";
	}
	
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div style="background: #CCCCCC; border-style: solid; border-width: 1px; border-color: #000000;">
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" onclick="setvalue ('<?php echo $userdata['nama_barang'];?>','<?php echo $userdata['kode_barang']; ?>')"><?php echo $userdata['nama_barang']; ?></div><?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}

	
?>