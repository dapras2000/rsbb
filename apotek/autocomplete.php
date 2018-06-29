<?php session_start();
	require_once ("../include/connect.php");
	$mysql 	= mysql_query('select * from m_barang where nama_barang like "%'.$_REQUEST['q'].'%" and group_obat = "'.$_REQUEST['jenis'].'"');
	if(mysql_num_rows($mysql) > 0){
		while($dsql = mysql_fetch_array($mysql)){
			echo $dsql['nama_barang']."|".$dsql['kode_barang']."|".$dsql['harga']."\n";
		}
	}
	
?>