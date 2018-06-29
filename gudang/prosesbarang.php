<?php
include("../include/connect.php");

if(!empty($_GET['opt'])){
	if($_GET['opt']=="1"){
	  	$kdbarang = "";
   		$nmbarang = "";
   		$group = "";
   		$satuan = "";
   		$harga = "";
		$title = "Add Barang";
	 include("../gudang/addbarang.php");
	}
	
	if($_GET['opt']=="2"){
	 if(!empty($_GET['idxbarang'])){
		$kdbarang = $_GET['idxbarang'];
		$sql = "SELECT kode_barang, nama_barang, group_barang, farmasi, satuan, harga, no_batch, expiry,pabrik
		FROM
  			m_barang
		WHERE kode_barang = '$kdbarang'";
		$get = mysql_query ($sql)or die(mysql_error());
		$brgdata = mysql_fetch_assoc($get);
		$kdbarang = $brgdata['kode_barang'];
		$nmbarang = $brgdata['nama_barang'];
		$group = $brgdata['group_barang'];
		$satuan = $brgdata['satuan'];
		$harga = $brgdata['harga'];
		$no_batch = $brgdata['no_batch'];
		$expiry = $brgdata['expiry'];
		$pabrik = $brgdata['pabrik'];
		
		$title = "Edit Barang";
 
	 include("../gudang/addbarang.php");
	 }
	}
	
	if($_GET['opt']=="3"){
		 
		 if(!empty($_GET['idxbarang'])){
			$kodebarang = $_GET['idxbarang'];
			$del = mysql_query("DELETE FROM m_barang WHERE kode_barang = $kodebarang");
			if($del){
				echo "";
			}
		 }
	}

}
?>