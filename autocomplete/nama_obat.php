<?php
if(isset($_REQUEST['q'])){
	$key = $_REQUEST['q'];
	include '../include/connect.php';
	if($key != ''):
		$join_unit 		= "";
		$search_unit 	= "";
		if(isset($_SESSION['KDUNIT'])){
			if($_SESSION['KDUNIT']!='12' && $_SESSION['KDUNIT']!='13'){
			  $unit 		= $_SESSION['KDUNIT'];
			  $join_unit 	= " inner join m_barang_unit on (m_barang_unit.kode_barang = m_barang.kode_barang) ";
			  $search_unit 	= " AND m_barang_unit.KDUNIT = ".$unit;
			}
		}
		
		#if(!empty($_GET['grp'])){
		$sql = "SELECT DISTINCT(nama_barang),m_barang.kode_barang, no_batch, expiry FROM m_barang ".$join_unit."
		WHERE LOWER(nama_barang) LIKE LOWER('" .$_GET['q']. "%') AND (group_barang = '1' OR group_barang = '2') AND farmasi= '1' ".$search_unit."
		ORDER BY nama_barang ASC";
		#}
		$query	= mysql_query($sql);
		if(mysql_num_rows($query) > 0):
			while ($data = mysql_fetch_array ($query)){
				echo $data['nama_barang']."|".$data['kode_barang']."|".$data['no_batch']."|".$data['expiry']."\n";
			}
		endif;
	endif;
}