<?php session_start();

	//autocomp.php

	//Add in our database connector.
	include("../include/connect.php");
	//And open a database connection.
	$join_unit = "";
	$search_unit = "";
	if($_SESSION['KDUNIT']!='12' && $_SESSION['KDUNIT']!='13'){
	  $unit = $_SESSION['KDUNIT'];
	  $join_unit = " inner join m_barang_unit on (m_barang_unit.kode_barang = m_barang.kode_barang) ";
	  $search_unit = " AND m_barang_unit.KDUNIT = ".$unit;
	}
	
	if(!empty($_GET['grp'])){
		$myquery = "SELECT DISTINCT(nama_barang),m_barang.kode_barang, no_batch, expiry FROM m_barang ".$join_unit."
		WHERE LOWER(nama_barang) LIKE LOWER('" . addslashes($_GET['sstring']) . "%') AND group_barang = '".$_GET['grp']."' AND farmasi= '".$_GET['farmasi']."' ".$search_unit."
		ORDER BY nama_barang ASC";
	}else{
		$myquery = "SELECT DISTINCT(nama_barang),m_barang.kode_barang, no_batch, expiry FROM m_barang ".$join_unit."
		WHERE LOWER(nama_barang) LIKE LOWER('" . addslashes($_GET['sstring']) . "%') ".$search_unit."
		ORDER BY nama_barang ASC";
	}
	
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div style="background: #CCCCCC; border-style: solid; border-width: 1px; border-color: #000000;">
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#CCCCCC'" onclick="setvalue ('<?php echo $userdata['nama_barang'];?>','<?php echo $userdata['kode_barang']; ?>','<?php echo $userdata['no_batch']; ?>','<?php echo $userdata['expiry']; ?>')"><?php echo $userdata['nama_barang']." [".$userdata['no_batch']."]";?></div><?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}

	
?>