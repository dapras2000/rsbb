<?php 
include("../include/connect.php");
unset($_SESSION['kdpoly']); 
$idx=$_GET['idx'];
$sql_daftar= "DELETE FROM t_pendaftaran WHERE IDXDAFTAR='$idx'";
mysql_query($sql_daftar);
$sql_tbayar= "DELETE FROM t_bayarrajal WHERE IDXDAFTAR='$idx'";
mysql_query($sql_tbayar);
?>
<script type="text/javascript">
	//self.location.href='index.php?cnama=&cnomr=&poly=0&crbayar=0&link=adminrajal&start=2018%2F03%2F04&end=2018%2F04%2F04';
	//var idx= <?php echo $idx;?>;
	//alert(idx);
	alert('Data berhasil dibatalkan');
	history.go(-1);
</script>