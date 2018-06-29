<?php if(!empty($_GET['idxbarang'])){
	
include("../include/connect.php");
include("../rajal/inc/function.php");

mysql_query("UPDATE t_pengembalian_barang SET status = '1' WHERE IDXBARANG = '".$_GET['idxbarang']."'");
						
$sqlsaldo = "SELECT saldo FROM t_barang_stok  WHERE kode_barang = '".$_GET['kdbarang']."' 
					  AND KDUNIT = '".$_SESSION['KDUNIT']."'
					  ORDER BY tanggal DESC, kd_stok DESC LIMIT 1";
					  $get = mysql_query ($sqlsaldo)or die(mysql_error());
		              $saldodata = mysql_fetch_assoc($get);
  					  $saldo = $saldodata['saldo'] + $_GET['jml'];
					  
					  @mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, masuk, saldo, KDUNIT) 
					VALUES ('".$_GET['kdbarang']."', curdate(),".$_GET['jml'].", '$saldo', '".$_SESSION['KDUNIT']."')")or die(mysql_error());
}
header("Location:../index.php?link=y83&unit=".$_GET['unit']."&tanggal=".$_GET['tanggal']."&nip=".$_GET['nip']);
exit;
?>
