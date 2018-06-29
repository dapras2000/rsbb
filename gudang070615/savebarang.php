<?php session_start();
include("../include/connect.php");

if($_SESSION['KDUNIT']=="12"){
  $farmasi = "1";
} else if($_SESSION['KDUNIT']=="13"){
  $farmasi = "0";
}
$kdbarang = $_POST['kdbarang'];
$nmbarang = $_POST['nmbarang'];
$group = $_POST['grpbarang'];
$satuan = $_POST['stbarang'];
$harga = $_POST['hrgbarang'];
$nobatch = $_POST['no_batch'];
$expiry = $_POST['TGLLAHIR'];

if($_POST['kdbarang']==""){
	
	$sql = "INSERT INTO m_barang(nama_barang, group_barang, farmasi, satuan, harga, no_batch, expiry)
		VALUES ('$nmbarang', '$group', '$farmasi', '$satuan', $harga, '$nobatch', '$expiry')";
  		$get = mysql_query($sql);
		if($get){
			echo "<fieldset class='fieldset'>";
            echo "<legend>Informasi</legend>";
			echo "Simpan Data Barang Berhasil.";
			echo "</fieldset>";
		}else{
		    require_once("../gudang/addbarang.php"); 
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
			harga = $harga,
			no_batch = '$nobatch',
			expiry = '$expiry'
		WHERE kode_barang = '$kdbarang'";
  		$get = mysql_query($sql);
		
		if($get){
			echo "<fieldset class='fieldset'>";
            echo "<legend>Informasi</legend>";
			echo "Simpan Data Barang Berhasil.";
			echo "</fieldset>";
		}else{
		    require_once("../gudang/addbarang.php"); 
			echo "<fieldset class='fieldset'>";
            echo "<legend>Error</legend>";
			echo "Simpan Data Barang Gagal.";
			echo "</fieldset>";
		}
}
?>