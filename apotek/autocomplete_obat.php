<?php session_start();
	require_once ("../include/connect.php");
	
$unit = 12; 
$c = 1;
$group = 1;

	  
	  $mysql 	= mysql_query('select *, 
			(SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang 
			AND KDUNIT = 14	
			ORDER BY  kd_stok DESC LIMIT 1 ) as stock 
			from m_barang where nama_barang like "%'.$_REQUEST['q'].'%" and group_barang IN (1,2) 
	 ORDER BY group_barang,nama_barang,harga desc');
	
	
	if(mysql_num_rows($mysql) > 0){
		while($dsql = mysql_fetch_array($mysql)){
			if ($dsql['stock']==""){
				$dsql['stock']=0;
			}
				echo $dsql['nama_barang']." - (".$dsql['stock'].")  - (".$dsql['pabrik'].")|".$dsql['kode_barang']."|".$dsql['harga']."|".$dsql['satuan']."|".$dsql['stock']."\n";
		}
	}
	
?>