<?php
	include '../include/connect.php';
	$myquery = "SELECT DISTINCT(jenis_penyakit),icd_code FROM icd WHERE LOWER(jenis_penyakit) LIKE LOWER('" . addslashes($_GET['sstring']) . "%') ORDER BY jenis_penyakit ASC limit 20";
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div style="background: #CCCCCC; border-style: solid; border-width: 1px; border-color: #000000;">
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" onclick="setvalue_icd3 ('<?php echo $userdata['jenis_penyakit'];?>','<?php echo $userdata['icd_code']; ?>')"><?php echo $userdata['jenis_penyakit']; ?></div><?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}	
?>