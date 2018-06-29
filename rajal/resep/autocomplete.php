<?php session_start();
	require_once ("../../include/connect.php");
	$mysql 	= mysql_query('select * from m_obat where nama_obat like "%'.$_REQUEST['q'].'%"');
	if(mysql_num_rows($mysql) > 0){
		while($dsql = mysql_fetch_array($mysql)){
			echo $dsql['nama_obat']."|".$dsql['kode_obat']."\n";
		}
	}
	
?>