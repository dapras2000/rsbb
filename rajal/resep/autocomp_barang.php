<?php session_start();
	require_once ("../../include/connect.php");
	$join_unit = "";
	$search_unit = "";
	if($_SESSION['KDUNIT']!='12' && $_SESSION['KDUNIT']!='13'){
	  $unit = $_SESSION['kdpoly'];
	  $join_unit = " inner join m_barang_unit on (m_barang_unit.kode_barang = m_barang.kode_barang) ";
	  $search_unit = " AND m_barang_unit.KDUNIT = ".$unit;
	}
	
	if(!empty($_GET['grp'])){
		$myquery = "SELECT DISTINCT(nama_barang),m_barang.kode_barang, no_batch, expiry FROM m_barang ".$join_unit."
		WHERE LOWER(nama_barang) LIKE LOWER('" . addslashes($_GET['sstring']) . "%') AND (group_barang = '1' OR group_barang = '2') AND farmasi= '".$_GET['farmasi']."' ".$search_unit." ORDER BY nama_barang ASC";
	}
	if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){
			?>
			<div align="left" style="background: #F5F5F5; border-style: solid; font:Verdana, Geneva, sans-serif; font-size:12px; border-width: 1px; border-color: #000000; overflow:scroll; height:200px; " >
			<?php
				while ($userdata = mysql_fetch_array ($userquery)){
					?><div onmouseover="this.style.background = '#EEEEEE'" onmouseout="this.style.background = '#F5F5F5'" onclick="setvalue ('<?php echo $userdata['nama_barang'];?>','<?php echo $userdata['kode_barang']; ?>','<?php echo $userdata['no_batch']; ?>','<?php echo $userdata['expiry']; ?>')" ><?php echo $userdata['nama_barang'];?></div><?php
				}
			?>
			</div>
			<?php
		}
	} else {
		echo mysql_error();
	}

	
?>