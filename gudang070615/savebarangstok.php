<?php session_start();
include("../include/connect.php");

$kdbarang = $_POST['kdbarang'];
$stok = $_POST['stok'];

$sql_unit = "INSERT INTO t_barang_stok(kode_barang, tanggal, saldo, KDUNIT)
			VALUES('".$kdbarang."', now(), '".$stok."', 12)";
@mysql_query($sql_unit);

echo "<fieldset class='fieldset'>";
echo "<legend>Informasi</legend>";
echo "Simpan Data Stok Berhasil.";
?>