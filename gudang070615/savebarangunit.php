<?php session_start();
include("../include/connect.php");

$kdbarang = $_POST['kdbarang'];

$sql = "DELETE FROM m_barang_unit WHERE kode_barang = ".$kdbarang;
@mysql_query($sql);

for($x = 1; $x < 25; $x++){
  if(!empty($_POST['brunit'.$x])){
      $unit = $_POST['brunit'.$x];
	  $sql_unit = "INSERT INTO m_barang_unit (kode_barang, KDUNIT) VALUES (".$kdbarang.",".$unit.")";
	  @mysql_query($sql_unit);
  }
}

echo "<fieldset class='fieldset'>";
echo "<legend>Informasi</legend>";
echo "Simpan Data Barang Berhasil.";
?>