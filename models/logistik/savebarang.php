<?php
include("../include/connect.php");

$kdbarang = $_POST['kdbarang'];
$nmbarang = $_POST['nmbarang'];
$group = $_POST['grpbarang'];
$satuan = $_POST['stbarang'];
$harga = $_POST['hrgbarang'];

if($_POST['kdbarang']==""){
	
	$sql = "INSERT INTO m_barang (nama_barang, group_barang, satuan, harga)
		VALUES ('$nmbarang', '$group', '$satuan', $harga)";
  		$get = mysql_query($sql);
		if($get){
			echo "<fieldset class='fieldset'>";
            echo "<legend>Informasi</legend>";
			echo "Simpan Data Barang Berhasil.";
			echo "</fieldset>";
		}else{
		    require_once("../logistik/addbarang.php"); 
			echo "<fieldset class='fieldset'>";
            echo "<legend>Error</legend>";
			echo "Simpan Data Barang Gagal.";
			echo "</fieldset>";
		}
}else{
	
$sql = "UPDATE m_barang 
        SET nama_barang = '$nmbarang', 
			group_barang = '$group', 
			satuan = '$satuan',
			harga = $harga
		WHERE kode_barang = '$kdbarang'";
  		$get = mysql_query($sql);
		
		if($get){
			echo "<fieldset class='fieldset'>";
            echo "<legend>Informasi</legend>";
			echo "Simpan Data Barang Berhasil.";
			echo "</fieldset>";
		}else{
		    require_once("../logistik/addbarang.php"); 
			echo "<fieldset class='fieldset'>";
            echo "<legend>Error</legend>";
			echo "Simpan Data Barang Gagal.";
			echo "</fieldset>";
		}
}
?>