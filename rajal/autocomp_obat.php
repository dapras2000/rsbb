<?php

	//autocomp.php

	//Add in our database connector.
	include("../include/connect.php");
    if(!empty($_GET['grp'])){
		$myquery = "SELECT DISTINCT(nama_obat),kode_obat FROM m_obat WHERE LOWER(nama_obat) LIKE LOWER('%" . addslashes($_GET['sstring']) . "%') AND group_obat = '".$_GET['grp']."' ORDER BY nama_obat ASC";
	}else{
		$myquery = "SELECT DISTINCT(nama_obat),kode_obat FROM m_obat WHERE LOWER(nama_obat) LIKE LOWER('%" . addslashes($_GET['sstring']) . "%') ORDER BY nama_obat ASC";
	}
	
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div style="background: #CCCCCC; border-style: solid; border-width: 1px; border-color: #000000;">
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" onclick="setvalueobat ('<?php echo $userdata['kode_obat'].' - '.$userdata['nama_obat']; ?>')"><?php echo $userdata['nama_obat']; ?></div><?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}

	
?>